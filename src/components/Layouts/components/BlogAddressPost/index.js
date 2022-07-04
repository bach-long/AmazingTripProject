import React, { useEffect, useState } from 'react';
import classNames from 'classnames/bind';
import styles from './BlogAddressPost.module.scss';
import Comments from '../CommentBlog/Comments';
import Comment from "../CommentBlog/Comment";
import getCookie from '../../../../hooks/getCookie';
// const [avatarUser, setAvatarUser] = useState();
// const [username, setUsername] = useState();
// const [datePost, setDatePost] = useState();
// const [star, setStar] = useState();
// const [title, setTitle] = useState();
// const [image, setImage] = useState();
// const [like, setLike] = useState();
// const [dislike, setDislike] = useState();
// const [comment, setComment] = useState();

const cx = classNames.bind(styles);

function BlogAddressPost({ postData }) {
    const userData = JSON.parse(getCookie('userin'));

    const [state, setState] = useState(-1) // dang la gia dinh vi chua co api;

    const [showComment, setShowComment] = useState(false);
    const [value, setValue] = useState('');
    const raw = JSON.stringify({
        "blog_address_id": postData.blog_address_id,
        "id_user": userData.id,
        "comment_address_content": value,
        //"comment_address_image": 'https://bcp.cdnchinhphu.vn/Uploaded/tranducmanh/2021_06_22/HaTinh.jpg'
    })
    const obj = {
        method: 'POST',
        headers: {
            "Content-Type": "application/json",
        },
        body: raw,
        redirect: 'follow'
    }

    function handleChange(e) {
        setValue(e.target.value)
        console.log(value);
    }
    function sendComment() {
        console.log(raw);
        fetch('http://127.0.0.1:8000/api/createCommentBlog', obj)
        .then((response) => { 
            return response.json() 
        })
        .then((responseJSON) => { 
            setShowComment(true);
            setValue(''); 
        });
    }

    function setUpReaction() {
        let a = state;
        if(state == 1) {
            setState(-1);
            a = -1
        }
        else {
            setState(1);
            a = 1
        }
        return a;
        //console.log(state);
    }
    function setDownReaction() {
        let a = state;
        if(state == 0) {
            setState(-1);
            a = -1
        }
        else{
            setState(0);
            a = 0;
        }
        //console.log(state);
        return a;
    }
    
    return (
        <div className={cx('feedback-blog')}>
            <div className={cx('user-post')}>
                <div className={cx('user-infor')}>
                    <img src="https://vnn-imgs-f.vgcloud.vn/2022/02/26/10/ronaldo-26.jpeg" alt=""
                    className={cx('user-avt')} />
                    <h4 className={cx('m-0')}>
                        Ronaldo
                        <br/>
                        <span className={cx('date-post')}>
                            6 tháng 6 năm 2022
                        </span>                    
                    </h4>
                </div>
                <i className={cx('fa-solid fa-ellipsis icon-more')}></i>
            </div>
            <div className={cx('post-container')}>
                <div className={cx('post-star')}>
                    <i className={cx('fa-solid fa-star')}></i>
                    <i className={cx('fa-solid fa-star')}></i>
                    <i className={cx('fa-solid fa-star')}></i>
                    <i className={cx('fa-solid fa-star')}></i>
                    <i className={cx('fa-solid fa-star')}></i>
                </div>
                <div className={cx('post-content')}>
                    <p className={cx('post-title')}>
                        {postData.blog_address_content}
                    </p>
                    <div className={cx('post-img')}>
                        {/* <img src="https://images.vietnamtourism.gov.vn/vn/images/2021/hoianvna.jpg" alt="" /> */}
                    </div>
                    <div className={cx('post-reaction')}>
                        <div className={cx('d-flex')}>
                            <div className={cx('d-flex align-items-center')}>
                                <button className={cx('btn-reaction')}>
                                    <i className={state != 1 ? 'fa-regular fa-thumbs-up' : 'text-primary fa-regular fa-thumbs-up'} 
                                    onClick={(e)=>{let x = setUpReaction(); 
                                        fetch('http://127.0.0.1:8000/api/reactBlog', {
                                            method: 'POST',
                                            headers: {
                                                "Content-Type": "application/json",
                                            },
                                            body: JSON.stringify({
                                                "blog_id": 1,
                                                "id_user": 2,
                                                "reaction": x
                                            }),
                                            redirect: 'follow'
                                        }).then(response => {return response.json()}).then(responseJSON=>{console.log(responseJSON)})}}></i>
                                </button>
                                <span className={cx('sum-like ms-1')}>100</span>
                            </div>
                            <div className={cx('d-flex align-items-center ms-3')}>  
                                <button className={cx('btn-reaction')}>
                                    <i className={state != 0 ? 'fa-regular fa-thumbs-down' : 'text-primary fa-regular fa-thumbs-down'} onClick={(e)=>{let x = setDownReaction(); 
                                    fetch('http://127.0.0.1:8000/api/reactBlog', {
                                        method: 'POST',
                                        headers: {
                                            "Content-Type": "application/json",
                                        },
                                        body: JSON.stringify({
                                            "blog_id": 1,
                                            "id_user": 2,
                                            "reaction": x
                                        }),
                                        redirect: 'follow'
                                    }).then(response => {return response.json()}).then(responseJSON=>{console.log(responseJSON)})}}></i>
                                </button>
                                <span className={cx('sum-dislike ms-1')}>15</span>
                            </div> 
                        </div>

                        <span 
                            className={cx('sum-comment')}
                            onClick={() => setShowComment(!showComment)}
                        >
                            20 Bình luận
                        </span>
                    </div>

                    <div className='comments'>
                        <div className={cx('user-comment')}>
                            <div className=''>
                                <img src="https://scontent.xx.fbcdn.net/v/t1.15752-9/281896920_534554055067659_2103376413571668716_n.jpg?stp=dst-jpg_s206x206&_nc_cat=101&ccb=1-7&_nc_sid=aee45a&_nc_ohc=j7BNtyGXhXAAX_hRifl&_nc_ad=z-m&_nc_cid=0&_nc_ht=scontent.xx&oh=03_AVLnllXQKcQizy9OEzLQUonG7eViUgPq4ynxejsTjcQClQ&oe=62D02342"
                                    alt="" className='rounded-circle d-inline' width={50} />
                            </div>
                            <div className={cx('input-comment')}>
                                <input
                                    value={value}
                                    type="text"
                                    placeholder="Viết bình luận ..."
                                    onChange={handleChange}
                                />
                                <button
                                    onClick={sendComment}
                                    className={cx('send-comment')}
                                >
                                    <i className="h4 fa-solid fa-paper-plane"></i>
                                </button>
                            </div>
                        </div>
                        { showComment && <Comments blog_address_id={postData.blog_address_id} /> }
                    </div>

                </div>
            </div>
        </div>
    )
}

export default BlogAddressPost;