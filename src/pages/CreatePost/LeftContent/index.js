import { useEffect, useState, useRef } from 'react';
import { useNavigate, useParams } from 'react-router-dom';
import Dropzone from 'react-dropzone';
import { FaStar } from "react-icons/fa";
import { useForm } from 'react-hook-form';
import { toast } from 'react-toastify';
import classNames from 'classnames/bind';
import styles from './LeftContent.module.scss';
import http from '../../../http';
import getCookie from '../../../hooks/getCookie';
import blogAddressPostApi from '../../../api/blogAddressPostApi';
import storeImage from '../../../hooks/storeImage';
import addressApi from '../../../api/addressApi';
import getImage from '../../../hooks/getImage';


const cx = classNames.bind(styles);

const colors = {
    orange: "#FFBA5A",
    grey: "#a9a9a9"
};

function LeftContent() {
    const navigate = useNavigate();
    const { id } = useParams();
    const imgRef = useRef();
    const btnDelRef = useRef();
    const current_user = JSON.parse(getCookie('userin'));

    const [showDelete, setShowDelete] = useState(false);
    const [delAble, setDelAble] = useState(false);
 
    const [previewAvatar, setPreviewAvatar] = useState('');
    const [addressData, setAddessData] = useState({});


    const {
        register,
        handleSubmit,
        formState: { errors },
    } = useForm();

    const [currentValue, setCurrentValue] = useState(0);
    const [hoverValue, setHoverValue] = useState(undefined);
    const stars = Array(5).fill(0);

    const [inputs, setInputs] = useState({
        id_user: current_user.id,
        address_id: id,
        blog_address_vote: currentValue,
        blog_address_content: '',
        blog_address_image: ''
    });

    const handleClick = (value) => {
        setCurrentValue(value);
        setInputs({...inputs, blog_address_vote: value})
    }

    const handleMouseOver = (newHoverValue) => {
        setHoverValue(newHoverValue)
    };

    const handleMouseLeave = () => {
        setHoverValue(undefined)
    }

    const handleDrop = async (e) => {
        const file = e[0];
        
        file.preview = URL.createObjectURL(file);
        setPreviewAvatar(file);
        const image = await storeImage(file);
        setInputs({ ...inputs,  blog_address_image: image});
    }

    const handleDel = () => {
        URL.revokeObjectURL(previewAvatar.preview);
        setPreviewAvatar('');
        setShowDelete(false);
        setDelAble(false);
    }


    const submitForm = async () => {
        try {
            await blogAddressPostApi.post(inputs);
            toast.success("Chia s??? c???a b???n ???? ???????c m???i ng?????i bi???t ?????n !!!", {
                toastId: 1,
            }); 
            navigate(-1);   
        } catch (error) {
            console.log('Toang meo chay r loi cc ', error);
        }
    }

    // X??a ???nh xem t???m th???i
    useEffect(() => {
        
        return () => {
            URL.revokeObjectURL(previewAvatar.preview);
        }
    }, [previewAvatar])

    useEffect(() => {
        const fetchAddress = async () => {
            try {
                const res = await addressApi.get(id, current_user.id);
                if(res.address?.avatar != null)
                {
                    const image = await getImage(res.address.avatar);
                    res.address.avatar = image;
                }
                setAddessData(res.address); 
            } catch (error) {
                console.log('Toang meo chay r loi cc:  ', error)
            }
        }

        fetchAddress();
    },[])

    
    return (
        <div className={cx('top-left')}>
            <div className={cx('address')}>
                <h2> {addressData?.address_name} </h2>
                <i className={cx('fa-solid fa-location-dot')}></i>
                <span className={cx('avatar')}>
                    <img src={addressData?.avatar} className={cx('avt-host')} />
                </span>
            </div>
            <div className={cx('top-form')}>
                <div style={styless.container}>
                    <h2>Chuy???n ??i c???a b???n th??? n??o ...? </h2>
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
                </div>


                <div className={cx('share')}>
                    <label htmlFor='content' className={cx('share-title')}>
                        Chia s???
                    </label>
                    <textarea
                        {...register("blog_address_content", { required: "Vui l??ng nh???p chia s??? c???a b???n" })}
                        id="content" 
                        cols="30" rows="9   "
                        placeholder="Chia s??? v???i m???i ng?????i v??? tr???i nghi???m c???a b???n: m?? t??? ?????a ??i???m, m???c ????? h??i l??ng v??? ph???c v???, g???i ?? cho kh??ch du l???ch?"

                        onChange={(e) =>
                            setInputs({ ...inputs, blog_address_content: e.target.value })
                        }
                    >
                    </textarea>
                    <p className={cx('validate')}>{errors.blog_address_content?.message}</p>

                </div>
                <div className={cx('moment')}>
                    <label htmlFor='post-image' className={cx('moment-title')}>
                        Kho???ng kh???c c???a b???n
                    </label>
                    <Dropzone 
                        onDrop={(e) => handleDrop(e)}
                        noClick={delAble}
                    >
                        {({getRootProps, getInputProps}) => (
                            <div
                                className={cx('drop-zone')} 
                                {...getRootProps()}
                                onMouseOver={() => setShowDelete(true)}
                                onMouseOut={() => setShowDelete(false)}
                            >
                                <input
                                    id='post-image'
                                    {...getInputProps()} 
                                />
                                <p>Chia s??? kho???nh kh???c c???a b???n v???i ch??ng t??i ... !!</p>
                                { previewAvatar !== '' && (
                                    <div className={cx('preview-image')}>
                                        <img 
                                            src={previewAvatar.preview}
                                        />
                                        { showDelete && (
                                            <div className={cx('del-area')}>
                                                <button
                                                    ref={btnDelRef}
                                                    className={cx('btn-del')}
                                                    onClick={() => handleDel()}
                                                    onMouseOver={() => setDelAble(true)}
                                                    onMouseOut={() => setDelAble(false)}
                                                >
                                                    <i className="fa-solid fa-circle-xmark"></i>
                                                </button>
                                            </div>
                                        )}
                                    </div>
                                )}
                            </div>
                        )}
                    </Dropzone>
                    <div className={cx('check')}>
                        <input type="checkbox" className={cx('accept')} />
                        <p className={cx('check-content')}>
                            T??i ch???ng nh???n r???ng ????nh gi?? n??y ???????c d???a tr??n tr???i nghi???m ri??ng c???a t??i v?? l?? ?? ki???n
                            ch??n th???c c???a t??i v??? c?? s??? n??y v?? r???ng t??i kh??ng c?? m???i li??n h??? c?? nh??n hay c??ng vi???c
                            n??o v???i c?? s??? n??y v?? kh??ng ???????c c?? s??? n??y t???ng hay thanh to??n ????? n??o ????? vi???t ????nh gi??
                            n??y.
                        </p>
                    </div>
                </div>
                <div className={cx('submit')}>
                    <button
                        className={cx('btn-submit')}
                        onClick={submitForm}
                    >
                        G???i ????nh gi?? c???a b???n
                    </button>
                </div>
            </div>
        </div>
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