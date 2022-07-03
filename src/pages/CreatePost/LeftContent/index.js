import classNames from 'classnames/bind';
import { Fragment } from 'react';
import styles from './LeftContent.module.scss';
import { useState } from "react";
import http from '../../../http';
import { useNavigate, useParams } from 'react-router-dom';
import { FaStar } from "react-icons/fa";
import getCookie from '../../../hooks/getCookie';
import { useForm } from 'react-hook-form';


const cx = classNames.bind(styles);

const colors = {
    orange: "#FFBA5A",
    grey: "#a9a9a9"

};

function LeftContent() {
    const {
        register,
        handleSubmit,
        formState: { errors },
    } = useForm();


    const navigate = useNavigate();

    const { id } = useParams();
    const current_user = JSON.parse(getCookie('userin'))

    const [currentValue, setCurrentValue] = useState(0);
    const [hoverValue, setHoverValue] = useState(undefined);
    const stars = Array(5).fill(0)

    const [inputs, setInputs] = useState({ id_user: current_user.id, address_id: parseInt(id) });

    const handleClick = value => {
        setCurrentValue(value);
        setInputs(values => ({ ...values, blog_address_vote: value }))
    }

    const handleMouseOver = newHoverValue => {
        setHoverValue(newHoverValue)
    };

    const handleMouseLeave = () => {
        setHoverValue(undefined)
    }


    const submitForm = () => {
        console.log(inputs);
        http.post('/blogAddress', inputs).then((res) => {
            navigate('/');
        })
        console.log(inputs)

    }
    return (
        <Fragment>
            <div className={cx('top-left')}>
                <div className={cx('address')}>
                    <h2 className={cx('name')}>
                        Hội An
                        <i className={cx('fa-solid fa-location-dot')}></i>
                        <span className={cx('avatar')}>
                            <img src="https://scontent.xx.fbcdn.net/v/t1.15752-9/281896920_534554055067659_2103376413571668716_n.jpg?stp=dst-jpg_s206x206&_nc_cat=101&ccb=1-7&_nc_sid=aee45a&_nc_ohc=j7BNtyGXhXAAX_hRifl&_nc_ad=z-m&_nc_cid=0&_nc_ht=scontent.xx&oh=03_AVLnllXQKcQizy9OEzLQUonG7eViUgPq4ynxejsTjcQClQ&oe=62D02342"
                                alt="" className={cx('avt-host')} />
                        </span>
                    </h2>
                </div>
                <div className={cx('top-form')}>


                    <div style={styless.container}>
                        <h2>Chuyến đi của bạn thế nào ...? </h2>
                        <div style={styless.stars}>
                            {stars.map((_, index) => {
                                return (
                                    <FaStar
                                        key={index}
                                        size={24}
                                        onClick={() => handleClick(index + 1)}
                                        onMouseOver={() => handleMouseOver(index + 1)}
                                        onMouseLeave={handleMouseLeave}
                                        color={(hoverValue || currentValue) > index ? colors.orange : colors.grey}
                                        style={{
                                            marginRight: 10,
                                            cursor: "pointer"
                                        }}
                                    />
                                )
                            })}
                        </div>
                        {/* <h1>{currentValue}</h1> */}
                    </div>


                    <div className={cx('share')}>
                        <h5 className={cx('share-title')}>
                            Chia sẻ
                        </h5>
                        <textarea {...register("blog_address_content", { required: "Vui lòng nhập chia sẻ của bạn" })} id="" cols="30" rows="8"

                            placeholder="Chia sẻ với mọi người về trải nghiệm của bạn: mô tả địa điểm, mức độ hài lòng về phục vụ, gọi ý cho khách du lịch?"></textarea>
                        <p className={cx('validate')}>{errors.blog_address_content?.message}</p>

                    </div>
                    <div className={cx('moment')}>
                        <h5 className={cx('moment-title')}>
                            Khoẳng khắc của bạn
                        </h5>
                        <div className={cx('wrapper')}>
                            <div className={cx('file-upload')}>
                                <input {...register("blog_address_image")} type="file" className={cx('choose-image')}
                                />
                                <i className={cx('fa fa-arrow-up')}></i>
                            </div>
                        </div>
                        {/* <p>{inputs}</p> */}
                        <div className={cx('check')}>
                            <input type="checkbox" className={cx('accept')} />
                            <p className={cx('check-content')}>
                                Tôi chứng nhận rằng đánh giá này được dựa trên trải nghiệm riêng của tôi và là ý kiến
                                chân thực của tôi về cơ sở này và rằng tôi không có mối liên hệ cá nhân hay công việc
                                nào với cơ sở này và không được cơ sở này tặng hay thanh toán để nào để viết đánh giá
                                này.
                            </p>
                        </div>
                    </div>
                    <div className={cx('submit')}>
                        <button className={cx('btn-submit')} onClick={handleSubmit(data => {
                            data.blog_address_vote = currentValue;
                            data.id_user = current_user.id;
                            data.address_id = parseInt(id);
                            data.blog_address_image = "chua luu duoc";
                            console.log(data)
                            http.post('/blogAddress', data).then((res) => {
                                navigate('/');
                            })

                        })}>
                            Gửi đánh giá của bạn
                        </button>
                    </div>
                </div>
            </div>
        </Fragment>
    );
}
const styless = {
    container: {
        display: "flex",
        flexDirection: "column",
        alignItems: "center"
    },
    stars: {
        display: "flex",
        flexDirection: "row",
    },

};

export default LeftContent;