import "./featuredInfo.css";
import { ArrowDownward, ArrowUpward } from "@material-ui/icons";
import { useState } from "react";
import { useEffect } from "react";
import http from '../../http'

export default function FeaturedInfo() {

  const [users, setUsers] = useState();
  const [hosts, setHosts] = useState();
  const [addresses, setAddresses] = useState();
  const [groups, setGroups] = useState();
  const [blogs, setBlogs] = useState();

  useEffect(() => {
    const fetch = async () => {
      const resUsers = await http.get('/numberofusers');
      setUsers(resUsers.data);
      const resHosts = await http.get('/numberofhosts');
      setHosts(resHosts.data);
      const resGroups = await http.get('/numberofgroups');
      setGroups(resGroups.data);
      const resAddresses = await http.get('/numberofaddresses');
      setAddresses(resAddresses.data);
      const resBlogs = await http.get('/allblogs');
      setBlogs(resBlogs.data);
    }
    fetch()

  }, [])


  return (
    <div className="featured">
      <div className="featuredItem">
        <span className="featuredTitle">Users</span>
        <div className="featuredMoneyContainer">
          <span className="featuredMoney">{users}</span>
          {/* <span className="featuredMoneyRate">
            -11.4 <ArrowDownward className="featuredIcon negative" />
          </span> */}
        </div>
        {/* <span className="featuredSub">Compared to last month</span> */}
      </div>
      <div className="featuredItem">
        <span className="featuredTitle">Hosts</span>
        <div className="featuredMoneyContainer">
          <span className="featuredMoney">{hosts}</span>
          {/* <span className="featuredMoneyRate">
            -1.4 <ArrowDownward className="featuredIcon negative" />
          </span> */}
        </div>
        {/* <span className="featuredSub">Compared to last month</span> */}
      </div>
      <div className="featuredItem">
        <span className="featuredTitle">Addresses</span>
        <div className="featuredMoneyContainer">
          <span className="featuredMoney">{addresses}</span>
          {/* <span className="featuredMoneyRate">
            +2.4 <ArrowUpward className="featuredIcon" />
          </span> */}
        </div>
        {/* <span className="featuredSub">Compared to last month</span> */}
      </div>
      <div className="featuredItem">
        <span className="featuredTitle">Groups</span>
        <div className="featuredMoneyContainer">
          <span className="featuredMoney">{groups}</span>
          {/* <span className="featuredMoneyRate">
            +2.4 <ArrowUpward className="featuredIcon" />
          </span> */}
        </div>
        {/* <span className="featuredSub">Compared to last month</span> */}
      </div>
      <div className="featuredItem">
        <span className="featuredTitle">Blogs</span>
        <div className="featuredMoneyContainer">
          <span className="featuredMoney">{blogs}</span>
          {/* <span className="featuredMoneyRate">
            +2.4 <ArrowUpward className="featuredIcon" />
          </span> */}
        </div>
        {/* <span className="featuredSub">Compared to last month</span> */}
      </div>
    </div>
  );
}
