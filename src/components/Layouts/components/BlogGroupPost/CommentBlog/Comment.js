import React, { useContext } from 'react';
import { useEffect, useState, useRef } from 'react';
import { toast } from 'react-toastify';
import styles from './Comment.module.scss' ;
import classNames from 'classnames/bind';
import commentGroupApi from '../../../../../api/commentGroupApi';
import getCookie from '../../../../../hooks/getCookie';
import { GroupPageContext } from '../../../../../pages/GroupPage/GroupPageContext';

const cx = classNames.bind(styles);


function Comment ({comment}) {
    const editStyle = {
        cursor: 'context-menu',
        outline: 'none'
    }

    const context = useContext(GroupPageContext);

    const userData = JSON.parse(getCookie('userin'));

    const inputRef = useRef();
    const toggleRef = useRef();

    const [showDot, setShowDot] = useState(false);
    const [showEdit, setShowEdit] = useState(false);
    const [edit, setEdit] = useState(false);

    const [editVal, setEditVal] = useState(comment);


    const handleDelete = () => {
        try {
            const comment_id = comment.comment_blog_id;
            context.handleResetCommentData(comment_id);
            commentGroupApi.delete(comment_id);
            toast.warning('Bình luận đã bị xóa !!!');
        } catch (error) {
            console.log('Toang meo chay roi loi cc: ', error)
        }
    }   

    const handleEdit = () => {
        setEdit(true);
        setShowEdit(false);
        inputRef.current.focus();
    }

    const handleSendEdit = () => {
        setEdit(false);
        try {
            commentGroupApi.patch(editVal);
        } catch (error) {
            console.log('Toang meo chay roi loi cc: ', error);
        }
    }

    useEffect(() => {
        const handler = (e) => {
            if(!toggleRef?.current?.contains(e.target))
                setShowEdit(false);
        }

        document.addEventListener('mousedown', handler)

        return () => {
            document.removeEventListener('mousedown', handler)
        }
    })
    
    return (
        <div className="mb-4" style={{ position: 'relative', }}>
            <div className={cx('avt-and-name')}>
                <img src="https://i.imgur.com/hczKIze.jpg" width="35" className="user-img rounded-circle m-2 col-xs-2" />
                <p className="d-inline">james_olesenn</p>
            </div>
            <div 
                className={cx('comment-area')}
                onMouseOver={() => setShowDot(true)}
                onMouseLeave={() => setShowDot(false)}
            >
                <input
                    ref={inputRef}
                    className={cx('comment')}
                    value={editVal.comment_blog_content}
                    onChange={(e) => 
                        setEditVal({...editVal, comment_blog_content: e.target.value})
                    }
                    readOnly={!edit}
                    style={ edit ? {} : editStyle}
                />
                { edit && (
                    <button
                        className={cx('btn-edit')}
                        onClick={() => handleSendEdit()}
                    >
                        <i className="fa-solid fa-paper-plane"></i>
                    </button>
                )}
                { comment.id_user === userData.id && showDot && !edit && (
                    <button
                        onClick={() => setShowEdit(!showEdit)}
                    >
                        <i className="fa-solid fa-ellipsis icon-more"></i>
                    </button>
                )}
                { showEdit && 
                    <div 
                        ref={toggleRef}
                        className={cx('btn-edit-del')}
                    >
                        <button 
                            className="btn-edit"
                            onClick={() => handleEdit()}
                        >
                            Chỉnh sửa
                        </button>

                        <button 
                            className="btn-del"
                            onClick={() => handleDelete()}
                        >
                            Xóa bình luận
                        </button>
                    </div>
                }
            </div>
        </div>
    )
}

export default Comment;