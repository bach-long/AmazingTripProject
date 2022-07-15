import { useContext } from 'react';
import { useEffect } from 'react';
import classNames from 'classnames/bind';
import styles from './CommentBlog.module.scss';
import Comment from "./Comment";
import { UserPageContext } from '../../../../../pages/UserPage/UserPageContext';
import commentAddressApi from '../../../../../api/commentAddressApi';

const cx = classNames.bind(styles);

const Comments = ({ blog_address_id }) => {
    
    const context = useContext(UserPageContext);
    
    useEffect(() => {
        const fetchCommentList = async () => {
            try {
                const res = await commentAddressApi.get(blog_address_id);
                context.setCommentsBlog(res.data);
            } catch (error) {
                console.log('Toang meo chay r loi cc ', error)
            }
        }

        fetchCommentList();
    }, []);

    return (
        <div className='listComments mt-3'>
            <div className="row  d-flex justify-content-center">
                <div className="col-md-12 mt-3">
                    {
                        context.commentsBlog?.map((item) => (
                                <Comment comment={item} key={item.comment_blog_id} />
                            )
                        )
                    }
                </div>
            </div>
        </div>
    )
}

export default Comments;
