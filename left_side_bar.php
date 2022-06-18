<style>
    .list-control {
    text-align: center;
    background-color: var(--background-light-blue);
    padding: 10px 0;
    margin-bottom: 10px;
    border-radius: 50px;
    }

    .sticky-side-bar { 
        position: sticky;
        top: 60px;
    }

    .side-bar a, .side-bar label {
        font-weight: bold;
        font-size: 18px;
        color: var(--background-dark-blue);
    }

    .list-control label {
        padding-bottom: 5px;
        border-bottom: 1px solid var(--background-dark-blue);
    }

    .list-control h6 {
        font-size: 16px;
        margin: 0;
        overflow: hidden;
    }

    .left-side-bar .list-control {
        border-radius: 10px;
    }
</style>

<div class="col-sm-2 side-bar left-side-bar">
    <ul class="list-unstyled sticky-side-bar">
        <li class="pt-3 pb-3 list-control" id="partner-list">
            <label for="list-users">Bạn đồng hành</label>
            <ul class="list-users list-unstyled">
                <li class="d-flex align-items-center ps-4 mt-3">
                    <img class="user-avatar rounded-circle" src="./assets/img/a.jpg" alt="User-avatar">
                    <h6 class="ms-2">User_name</h6>
                </li>
                <li class="d-flex align-items-center ps-4 mt-3">
                    <img class="user-avatar rounded-circle" src="./assets/img/a.jpg" alt="User-avatar">
                    <h6 class="ms-2">User_name</h6>
                </li>
                <li class="d-flex align-items-center ps-4 mt-3">
                    <img class="user-avatar rounded-circle" src="./assets/img/a.jpg" alt="User-avatar">
                    <h6 class="ms-2">User_name</h6>
                </li>
            </ul>
        </li>
        <li class=" pt-3 pb-3 list-control" id="group-location-list">
            <label for="list-users">Nhóm địa điểm</label>
            <ul class="list-users list-unstyled">
                <li class="d-flex align-items-center ps-4 mt-3">
                    <img class="user-avatar rounded-circle" src="./assets/img/a.jpg" alt="User-avatar">
                    <h6 class="ms-2">Hội An Team</h6>
                </li>
                <li class="d-flex align-items-center ps-4 mt-3">
                    <img class="user-avatar rounded-circle" src="./assets/img/a.jpg" alt="User-avatar">
                    <h6 class="ms-2">Unknow Team</h6>
                </li>
            </ul>
        </li>
    </ul>
</div>