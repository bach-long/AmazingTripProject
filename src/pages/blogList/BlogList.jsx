import "./blogList.css";
import { DataGrid } from "@material-ui/data-grid";
import { useState } from "react";
import { useEffect } from "react";
import http from "../../http";
import {Link} from 'react-router-dom';
import { DeleteOutline } from "@material-ui/icons";


export default function BlogList() {
  const [data, setData] = useState([]);
  useEffect(() => {
    const fetch = async () => {
      const res = await http.get('/blogs');
      const needData = res.data.data.map(blog => {

        return {
          id: blog.blog_id,
          Name: blog.blog_name,
          Content: blog.blog_content,
          Title: blog.blog_title,
          Group: blog.group_id,
          User: blog.user_id,
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
      field: "Content",
      headerName: "Content",
      width: 120,
    },
    {
      field: "Title",
      headerName: "Title",
      width: 300,
    },{
      field: "Group",
      headerName: "Group",
      width: 300,
    },{
      field: "User",
      headerName: "User",
      width: 300,
    },
    // {
    //   field: "nickname",
    //   headerName: "Nickname",
    //   width: 200,
    // },
    {
      field: "action",
      headerName: "Action",
      width: 150,
      renderCell: (params) => {
        return (
          <>
            <Link to={"/user/" + params.row.id}>
              <button className="userListEdit">Edit</button>
            </Link>
            <DeleteOutline
              className="userListDelete"
              // onClick={() => handleDelete(params.row.id)}
            />
          </>
        );
      },
    },
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
