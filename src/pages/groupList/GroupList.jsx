import "./groupList.css";
import { DataGrid } from "@material-ui/data-grid";
import { useState } from "react";
import { useEffect } from "react";
import http from "../../http";

export default function GroupList() {
  const [data, setData] = useState([]);
  useEffect(() => {
    const fetch = async () => {
      const res = await http.get('/groups');
      const needData = res.data.data.map(group => {

        return {
          id: group.group_id,
          Name: group.group_name,
          Admin: group.group_admin,
          Member: group.group_member,
          Address: group.address_id
        }
      })
      setData(needData);
    };
    fetch();
  }, [])

  
  const columns = [
    { field: "id", headerName: "ID", width: 90 },

    
    { field: "Name", headerName: "Name", width: 200 },
    {
      field: "Admin",
      headerName: "Admin",
      width: 120,
    },
    {
      field: "Member",
      headerName: "Member",
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
