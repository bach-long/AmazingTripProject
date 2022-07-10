import "./hostList.css";
import { DataGrid } from "@material-ui/data-grid";
import { DeleteOutline } from "@material-ui/icons";
import { userRows } from "../../dummyData";
import { Link } from "react-router-dom";
import { useState } from "react";
import { useEffect } from "react";
import http from "../../http";

export default function HostList() {
  const [data, setData] = useState([]);
  useEffect(() => {
    const fetch = async () => {
      const res = await http.get('/infoofhosts');
      const needData = res.data.map(user => {
        return {
          id: user.id, username: user.username, email: user.email, phone: user.phone, address: user.address, nickname: user.nickname
        }
      })
      setData(needData);
    };
    fetch();
  }, [])

  // const handleDelete = (id) => {
  //   // setData(data.filter((item) => item.id !== id));
  //   http.delete(`/delete/`+id).then(res =>
  //     console.log(res))
  // };

  const columns = [
    { field: "id", headerName: "ID", width: 90 },
    {
      field: "username",
      headerName: "User",
      width: 200,
      renderCell: (params) => {
        return (
          <div className="userListUser">
            <img className="userListImg" src={params.row.avatar} alt="" />
            {params.row.username}
          </div>
        );
      },
    },
    { field: "email", headerName: "Email", width: 200 },
    {
      field: "phone",
      headerName: "Phone",
      width: 120,
    },
    {
      field: "address",
      headerName: "Address",
      width: 300,
    },
    {
      field: "nickname",
      headerName: "Nickname",
      width: 200,
    },
    // {
    //   field: "action",
    //   headerName: "Action",
    //   width: 150,
    //   renderCell: (params) => {
    //     return (
    //       <>
    //         <Link to={"/user/" + params.row.id}>
    //           <button className="userListEdit">Edit</button>
    //         </Link>
    //         <DeleteOutline
    //           className="userListDelete"
    //           // onClick={() => handleDelete(params.row.id)}
    //         />
    //       </>
    //     );
    //   },
    // },
  ];

  return (
    <div className="userList">
      <DataGrid
        rows={data}
        disableSelectionOnClick
        columns={columns}
        pageSize={8}
      // checkboxSelection
      />
    </div>
  );
}
