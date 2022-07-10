import "./blogAddressList.css";
import { DataGrid } from "@material-ui/data-grid";
import { useState } from "react";
import { useEffect } from "react";
import http from "../../http";
import {Link} from 'react-router-dom';
import { DeleteOutline } from "@material-ui/icons";

export default function BlogAddressList() {
  const [data, setData] = useState([]);
  useEffect(() => {
    const fetch = async () => {
      const res = await http.get('/blogaddresses');
      const needData = res.data.map(blog => {

        return {
          id: blog.blog_address_id,
          Title: blog.blog_address_title,
          Content: blog.blog_address_content,
          AddressId: blog.address_id,
          UserId: blog.id_user,
        }
      })
      setData(needData);
    };
    fetch();
  }, [])

  const handleDelete = (id) => {
    setData(data.filter((item) => item.id !== id));
    http.delete(`/blogaddress/`+id).then(res =>
      console.log(res))
  };


  const columns = [
    { field: "id", headerName: "ID", width: 90 },


    { field: "Title", headerName: "Title", width: 200 },
    {
      field: "Content",
      headerName: "Content",
      width: 300,
    },
    {
      field: "AddressId",
      headerName: "AddressId",
      width: 200,
    }, {
      field: "UserId",
      headerName: "UserId",
      width: 200,
    },
    
    {
      field: "action",
      headerName: "Action",
      width: 150,
      renderCell: (params) => {
        return (
          <>
            <DeleteOutline
              className="userListDelete"
              onClick={() => handleDelete(params.row.id)}
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
