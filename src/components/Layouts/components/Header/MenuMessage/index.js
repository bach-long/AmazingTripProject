import { useContext } from 'react';
import styles from './MenuNotification.module.scss';
import classNames from 'classnames/bind';
import { GlobalContext } from '../../../../../context/GlobalContext';
import { MessageContext } from '../../../../../context/MessageContext';
import getCookie from '../../../../../hooks/getCookie';
import { UserPageContext } from '../../../../../pages/UserPage/UserPageContext';
const cx = classNames.bind(styles);


const data = [
    {
        id: 1,
        avatar: 'https://nld.mediacdn.vn/2020/5/29/doi-hoa-tim-5-1590731334546464136746.jpg',
        nickname: 'thdeathzz',
    },
    {
        id: 2,
        avatar: 'https://1.bp.blogspot.com/-1F0txd6CTXk/XyjEn1_2atI/AAAAAAAAiX0/2X1yKYprbxEAPvrNA4VoX_nuv8nawCSuQCNcBGAsYHQ/d/a5a84b393a0778e047f87c79478481e7.jpg',
        nickname: 'Unknow101><',
    },
    
]

function MenuMessgae() {
    const globalContext = useContext(GlobalContext);
    const {rooms, selectedRoom, setSelectedRoom, old} = useContext(MessageContext);
    const userContext= useContext(UserPageContext);
    // set roomData to globalContext
    const handleOpenChatbox = (room) => {
        setSelectedRoom(room);
        globalContext.setShowChatBox(true);
        userContext.setOld(true);
    };
    let userData ;
    const res = getCookie('userin');
    if(res)
        userData = JSON.parse(res);
    //console.log(selectedRoom);
    return (
        <div className={cx('noti-container')}>
            <h3 className={cx('title')}>Tin nhắn</h3>
            <ul className={cx('noti-content')}>
                {rooms.length !== 0 ? (
                    rooms.map((each) => (
                        <li
                            key={each.id}
                            className={cx('each-noti')}
                        >
                            <button
                                className={cx('btn-noti')}
                                onClick={(room) => handleOpenChatbox(each)}
                            >
                                <div className={cx('btn-content')}>
                                    <img className={cx('avatar')} src={userData.avatar == each.user1ava ? each.user2ava : each.user1ava}/>
                                    <h4>{userData.nickname == each.user1nn ? each.user2nn : each.user1nn}</h4>
                                </div>
                            </button>
                        </li>
                    ))
                ) : (
                    <h5 className={cx('empty-noti')}>Bạn không có tin nhắn nào !!!</h5>
                )}
            </ul>
        </div>
    );
}

export default MenuMessgae;