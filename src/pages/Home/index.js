import { Fragment } from 'react';
import { Link, useNavigate } from 'react-router-dom';
import removeCookie from '../../hooks/removeCookie';

function Home() {
    const navigate = useNavigate();

    const handlerLogout = () => {
        removeCookie('userin');
        navigate('/landing');
    }

    
    return (
        <Fragment>
            <div style={{ height: '1000px' }}>
                <h1>
                    Home Page
                    <br/>
                    <Link to="/listAddresses">Danh sách địa điểm</Link>
                    <br/>
                    <Link to="/host">Trang của host</Link>
                    <br/>
                    <Link to="/user">Trang của người dùng</Link>
                    <br/>
                    <Link to="/group">Trang nhóm</Link>
                    <br/>
                    <button
                        onClick={() => handlerLogout()}
                    >
                        Đăng xuất
                    </button>
                </h1>
            </div>
        </Fragment>
    )
}

export default Home;