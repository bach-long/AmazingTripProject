import { Link, useNavigate } from 'react-router-dom';
import { useState, useEffect, useRef } from 'react';
import classNames from 'classnames/bind';
import styles from './Header.module.scss';
import images from '../../../../assets/images';
import getCookie from '../../../../hooks/getCookie';

import Menu from './MenuDropDown';
import { db } from '../../../../firebase';

const cx = classNames.bind(styles);

function Header() {
    const history = useNavigate();
    //const userData = JSON.parse(getCookie('userin'));

    const [showMenu, setShowMenu] = useState(false);
    const [userData, setUserData] = useState(''); 
    const [notiCount, setNotiCount] = useState(0);
    const [notification, setNotification] = useState([]);

    const closeRef = useRef();

    console.log(notiCount);

    useEffect(() => {
        const res = getCookie('userin');
        let resJSON = JSON.parse(res);
        if(res)
            setUserData(resJSON);
        let data = db.collection('notifications').where('user2', 'array-contains', resJSON.id);
        let count = data.where('seen', '==', 0)
        data.onSnapshot((snapshot)=>{
            const Doc = snapshot.docs.map((doc)=>({...doc.data(), id:doc.id}))
        })
        count.onSnapshot((snapshot)=>{
            setNotiCount(snapshot.size)
        })

    }, [])

    useEffect(() => {
        const handler = (e) => {
            if(!closeRef?.current?.contains(e.target))
                setShowMenu(false);
        }

        document.addEventListener('mousedown', handler);

        return () => {
            document.removeEventListener('mousedown', handler);
        }
    })

    return (
        <header className={cx('sticky-top pt-2 pb-2')}>
            <div className={cx('container-fluid d-sm-flex justify-content-between align-items-center')}>
                <div className={cx('d-flex align-items-center')}>
                    <Link to='/'>
                        <img src={images.logo} alt="Logo" className={cx('nav-logo')}/>
                    </Link>
                    <button onClick={() => history(-1)} className={cx('btn-go-back')}>
                        <i className="fa-solid fa-angle-left me-1"></i>
                        <span>Quay lại</span>
                    </button>
                </div>
                <div className={cx('search-bar')}>
                    <form action="#" className={cx('input-group')}>
                        <div className={cx('d-sm-flex align-items-center')}>
                            <span className={cx('search-icon')}><i className={cx('fa-solid fa-magnifying-glass me-sm-2')}></i></span>
                            <input className={cx('flex-grow-1')} type="text" placeholder="Nơi bạn muốn tới..."/>
                            <span className={cx('delete-icon')}><i className={cx('fa-solid fa-xmark ps-2')}></i></span>
                        </div>
                    </form>
                </div>
                {
                    userData !== '' ? (
                    <ul className={cx('list-unstyled d-sm-flex align-items-center m-0 nav-left-group')}>
                        <li className={cx('message')}><i className={cx('fa-brands fa-facebook-messenger')}></i></li>
                        <li className={cx('notification')}><i className={cx('fa-regular fa-bell ms-sm-2')}></i></li>
                        <li ref={closeRef} className={cx('user-avatar')}>
                            <button 
                                className={cx('btn-avatar')}
                                onClick={() => setShowMenu(!showMenu)}
                            >
                                <img src={userData.avatar ? userData.avatar : images.defaultAvatar} alt="User-avatar" className={cx('rounded-circle')}/>
                            </button>
                            {showMenu && <Menu userData={userData}/>}
                        </li>
                    </ul>
                    ) : (
                        <Link to='/login'>
                            <button className={cx('btn-login')}>
                                Đăng nhập
                            </button>
                        </Link>
                    )
                }
            </div>
        </header>
    );
}

export default Header;