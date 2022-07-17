import React, { useState, useContext } from 'react';
import classNames from 'classnames/bind';
import styles from './Bottom.module.scss';
import { BlogAddressContext } from '../../BlogAddressContext';

const cx = classNames.bind(styles);

function Bottom() {

    const context = useContext(BlogAddressContext)

    return (
        <div className={cx('center-left-bottom')}>
            {context.discountData ? (
                <>
                    <h4>
                        Từ ngày
                        <span className={cx('day-start')}>
                            {new Date(context.discountData?.time_start).toLocaleDateString()}
                        </span> tới ngày
                        <span className={cx('day-end')}>
                            {new Date(context.discountData?.time_finish).toLocaleDateString()}
                        </span>
                    </h4>
                    <p className={cx('block-discount')}>
                        Giảm giá tới
                        <span className={cx('discount')}>
                            {context.discountData?.discount_rate}%
                        </span>
                    </p>
                    <p className={cx('dess2')}>
                        <span className={cx('quantity')}>
                            {context.discountData?.discount_quantity}
                        </span> quý khách đầu tiên
                    </p>
                    <div className={cx('sub')}>
                        <h5 className={cx('submit')}>
                            Số lượng đã đăng ký:
                            <span className={cx('sb')}>
                                {context.discountData?.quantity_registed}
                                /
                                {context.discountData?.discount_quantity}
                            </span>
                        </h5>
                        <button
                            onClick={context.toggleForm}
                            className={cx('btn-register')}
                        >
                            Đăng ký
                        </button>
                    </div>
                </>
            ) : (
                <h3>Địa điểm chưa có giảm giá</h3>
            )}

        </div>
    )
}

export default Bottom;