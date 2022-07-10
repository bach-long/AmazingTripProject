import "./addressList.css";
import { DataGrid } from "@material-ui/data-grid";
import { DeleteOutline } from "@material-ui/icons";
import { userRows } from "../../dummyData";
import { Link } from "react-router-dom";
import { useState } from "react";
import { useEffect } from "react";
import http from "../../http";

export default function AddressList() {
  const [data, setData] = useState([]);
  useEffect(() => {
    const fetch = async () => {
      const res = await http.get('/addresses');
      const needData = res.data.data.map(address => {

        return {
          id: address.address_id,
          Id_Host: address.id_host,
          Name: address.address_name,
          Description: address.address_description,
          Map: address.address_map
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

    // {
    //   field: "Id_Host",
    //   headerName: "Id_Host",
    //   width: 200,
    //   // renderCell: (params) => {
    //   //   return (
    //   //     <div className="userListUser">
    //   //       <img className="userListImg" src={params.row.avatar} alt="" />
    //   //       {params.row.username}
    //   //     </div>
    //   //   );
    //   // },
    // },
    { field: "Name", headerName: "Name", width: 200 },
    {
      field: "Description",
      headerName: "Description",
      width: 120,
    },
    {
      field: "Map",
      headerName: "Map",
      width: 300,
    },
    // {
    //   field: "nickname",
    //   headerName: "Nickname",
    //   width: 200,
    // },
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
