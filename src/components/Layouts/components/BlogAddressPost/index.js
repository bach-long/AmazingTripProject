import { useState, useEffect, useRef, useContext } from 'react';
import { toast } from 'react-toastify';
import moment from 'moment';
import { FaStar } from "react-icons/fa";
import classNames from 'classnames/bind';
import styles from './BlogAddressPost.module.scss';
import ReadMore from '../ReadMore';
import { BlogAddressContext } from '../../../../pages/BlogAddress/BlogAddressContext';
import { CommentContext } from './ReactComment/CommentContext';
import blogAddressPostApi from '../../../../api/blogAddressPostApi';
import commentAddressApi from '../../../../api/commentAddressApi';
import getImage from '../../../../hooks/getImage';
import images from '../../../../assets/images';
import ReactComment from './ReactComment';
import getCookie from '../../../../hooks/getCookie';
import { db } from '../../../../firebase';
import firebase from '../../../../firebase';

const cx = classNames.bind(styles);

function BlogAddressPost({ postData, slideShow }) {
    const userData = JSON.parse(getCookie('userin'));
    const context = useContext(BlogAddressContext);
    const commentContext = useContext(CommentContext);
    const deleteBtnRef = useRef();

    const [showDelete, setShowDelete] = useState(false);
    const currentValue = parseInt(postData.blog_address_vote);

    const [ava, setAva] = useState('');
    const [blogImg, setBlogImg] = useState('');
    const stars = Array(5).fill(0);

    const colors = {
        orange: "#FFBA5A",
        grey: "#a9a9a9"
    };

    function notify() {
        const query = db.collection('notifications');
        query.add({
            user1: userData.id,
            user2: postData.id_user,
            content: 'bài viết đã bị báo cáo vì vi phạm tiêu chuẩn cộng đồng',
            address_id: postData.address_id,
            blog_address_id: postData.blog_address_id,
            seen: 0,
            createdAt: firebase.firestore.FieldValue.serverTimestamp(),
        });
      }

    const handleDelete = async () => {
        try {
            context.handleResetPostData(postData.blog_address_id);
            blogAddressPostApi.delete(postData.blog_address_id);
            toast.warning('Bài viết đã bị xóa !!!', {
                toastId: 1,
            });
        } catch (error) {
            console.log('Toang meo chay roi loi cc:', error)
        }
    }

    useEffect(() => {
        const handler = (e) => {
            if(!deleteBtnRef?.current.contains(e.target))
                setShowDelete(false);
        }

        document.addEventListener('mousedown', handler)

        return () => {
            document.removeEventListener('mousedown', handler)
        }
    })

    // get Image url from firebase
    useEffect(() => {
        const getImageUrl = async () => {
            if(postData.avatar !== null)
            {
                const res = await getImage(postData.avatar);
                setAva(res);
            }
            if(postData?.blog_address_image !== null)
            {
                const res2 = await getImage(postData.blog_address_image);
                setBlogImg(res2);
            }
        }
        
        getImageUrl();
    }, [])

    // Get Comment Data
    useEffect(() => {
        const fetchCommentList = async () => {
            if(slideShow !== undefined && !slideShow)
            {
                try {
                    const res = await commentAddressApi.get(postData.blog_address_id);
                    commentContext.setCommentsBlog([...commentContext.commentsBlog, ...res.data]);
                } catch (error) {
                    console.log('Toang meo chay r loi cc ', error)
                }
        
            }
        }
        fetchCommentList();
    }, []);

    return (
        <div className={cx('feedback-blog')}>
            <div className={cx('user-post')}>
                <div className={cx('user-infor')}>
                    <div>
                        <img 
                            src={ava || images.defaultava}
                            alt="A image"
                            className={cx('user-avt')} 
                        />
                        <h4 className={cx('m-0')}>
                            {postData?.nickname}
                            <br/>
                            <span className={cx('date-post')}>
                                {moment(postData.created_at).format('D [tháng] M [năm] YYYY')}
                            </span>                    
                        </h4>
                    </div>
                    <div
                        ref={deleteBtnRef}
                    >
                        <button
                            onClick={() => setShowDelete(!showDelete)}
                            className={cx('btn-more')}
                        >
                            <i className={cx('fa-solid fa-ellipsis icon-more')}></i>
                        </button>
                        {showDelete && (
                            <div 
                                className={cx('delete-area')}
                            >
                                <button onClick={() => handleDelete()}>
                                    Xóa bài viết
                                </button>
                                <button onClick={notify}>
                                    Report
                                </button>
                            </div>
                            
                        )}
                    </div>
                </div>
                <div style={{ display: 'flex' }}>
                    {stars.map((_, index) => {
                        return (
                            <FaStar
                                key={index}
                                size={20}
                                color={currentValue > index ? colors.orange : colors.grey}
                                style={{ marginRight: '5'}}
                            />
                        )
                    })}
                </div>
                {/* <div className={cx('post-star')}>
                    <i className={cx('fa-solid fa-star')}></i>
                    <i className={cx('fa-solid fa-star')}></i>
                    <i className={cx('fa-solid fa-star')}></i>
                    <i className={cx('fa-solid fa-star')}></i>
                    <i className={cx('fa-solid fa-star')}></i>
                </div> */}
            </div>
            <div className={cx('post-content')}>
                <ReadMore limit={200}>{postData.blog_address_content}</ReadMore>
                <div className={cx('post-img')}>
                    { blogImg && 
                        <img 
                            src={blogImg} 
                            alt="A image"
                            className={cx('blog-image')} 
                        />
                    }
                </div>
                <ReactComment postData={postData}/>
            </div>
        </div>
    )
}

export default BlogAddressPost;