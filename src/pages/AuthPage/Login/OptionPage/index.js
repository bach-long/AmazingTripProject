import { Fragment } from 'react';
import classNames from 'classnames/bind';
import styles from './OptionPage.module.scss';
import images from '../../../../assets/images';
import firebase, {auth, db} from '../../../../firebase';

const cx = classNames.bind(styles);
const fbProvider = new firebase.auth.FacebookAuthProvider();

function OptionPage({ handleSetPage }) {
	const handleFacebookLogin = async ()=>{
        const {additionalUserInfo, user} = await auth.signInWithPopup(fbProvider);
        console.log(user.displayName);
        /*if(additionalUserInfo.isNewUser == true) {
            addDocument('users', {displayName: user.displayName,
                email: user.email,
                photoURL: user.photoURL,
                uid: user.uid,
                providerId: additionalUserInfo.providerId})
        }*/
    }

    return ( 
        <Fragment>
            <span className={cx('title')}>
				Cùng 
				<span className={cx('subtitle')}> AmazingTrip </span>
				khám phá thế giới
			</span>
			<button 
				onClick={() => handleSetPage(true)}
				className={cx('btn-control')}
			>
				<i className="fa-regular fa-user"></i>
				<span className={cx('optionContent')}>Sử dụng SĐT</span>
			</button>

			<button className={cx('btn-control')}>
				<img src={images.google} alt='Google' />
				<span className={cx('optionContent')}>Tiếp tục với Google</span>
			</button>
			<button className={cx('btn-control')} onClick={handleFacebookLogin}>
				<img src={images.facebook} alt='facebook' />
				<span className={cx('optionContent')}>
					Tiếp tục với Facebook
				</span>
			</button>
        </Fragment>
    );
}

export default OptionPage;