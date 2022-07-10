import Chart from "../../components/chart/Chart";
import FeaturedInfo from "../../components/featuredInfo/FeaturedInfo";
import "./home.css";
import WidgetSm from "../../components/widgetSm/WidgetSm";
import WidgetLg from "../../components/widgetLg/WidgetLg";

import http from "../../http";
import { useState, useEffect } from "react";

export default function Home() {
  const [userData, setUserData] = useState([]);
  const [hostData, setHostData] = useState([]);
  const [groupsData, setGroupsData] = useState([]);
  const [addressData, setAddressData] = useState([]);
  const [blogsData, setBlogsData] = useState([])

  useEffect(() => {

    const fetch = async () => {
      const res = await http.get('/usersbydate');
      setUserData([{
        name: res.data.date1,
        "Users": res.data.count1
      }, {
        name: res.data.date2,
        "Users": res.data.count2
      }, {
        name: res.data.date3,
        "Users": res.data.count3
      }, {
        name: res.data.date4,
        "Users": res.data.count4
      }, {
        name: res.data.date5,
        "Users": res.data.count5
      }, {
        name: res.data.date6,
        "Users": res.data.count6
      }, {
        name: res.data.date7,
        "Users": res.data.count7
      }])
      const resHost = await http.get('/hostsbydate')
      setHostData([{
        name: resHost.data.date1,
        "Hosts": resHost.data.count1
      }, {
        name: resHost.data.date2,
        "Hosts": resHost.data.count2
      }, {
        name: resHost.data.date3,
        "Hosts": resHost.data.count3
      }, {
        name: resHost.data.date4,
        "Hosts": resHost.data.count4
      }, {
        name: resHost.data.date5,
        "Hosts": resHost.data.count5
      }, {
        name: resHost.data.date6,
        "Hosts": resHost.data.count6
      }, {
        name: resHost.data.date7,
        "Hosts": resHost.data.count7
      }])
      const resGroups = await http.get('/groupsbydate');
      setGroupsData([{
        name: resGroups.data.date1,
        "Groups": resGroups.data.count1
      }, {
        name: resGroups.data.date2,
        "Groups": resGroups.data.count2
      }, {
        name: resGroups.data.date3,
        "Groups": resGroups.data.count3
      }, {
        name: resGroups.data.date4,
        "Groups": resGroups.data.count4
      }, {
        name: resGroups.data.date5,
        "Groups": resGroups.data.count5
      }, {
        name: resGroups.data.date6,
        "Groups": resGroups.data.count6
      }, {
        name: resGroups.data.date7,
        "Groups": resGroups.data.count7
      }])
      const resBlogs = await http.get('/blogsbydate');
      setBlogsData([{
        name: resBlogs.data.date1,
        "Blogs": resBlogs.data.count1
      }, {
        name: resBlogs.data.date2,
        "Blogs": resBlogs.data.count2
      }, {
        name: resBlogs.data.date3,
        "Blogs": resBlogs.data.count3
      }, {
        name: resBlogs.data.date4,
        "Blogs": resBlogs.data.count4
      }, {
        name: resBlogs.data.date5,
        "Blogs": resBlogs.data.count5
      }, {
        name: resBlogs.data.date6,
        "Blogs": resBlogs.data.count6
      }, {
        name: resBlogs.data.date7,
        "Blogs": resBlogs.data.count7
      }])

      const resAddresses = await http.get('/addressesbydate');
      setAddressData(
        [{
          name: resAddresses.data.date1,
          "Addresses": resAddresses.data.count1
        }, {
          name: resAddresses.data.date2,
          "Addresses": resAddresses.data.count2
        }, {
          name: resAddresses.data.date3,
          "Addresses": resAddresses.data.count3
        }, {
          name: resAddresses.data.date4,
          "Addresses": resAddresses.data.count4
        }, {
          name: resAddresses.data.date5,
          "Addresses": resAddresses.data.count5
        }, {
          name: resAddresses.data.date6,
          "Addresses": resAddresses.data.count6
        }, {
          name: resAddresses.data.date7,
          "Addresses": resAddresses.data.count7
        }]

      )

    };
    fetch()

  }, [])


  return (
    <div className="home">
      <FeaturedInfo />
      <Chart data={userData} title="Users Analytics" grid dataKey="Users" />
      {/* <div className="homeWidgets">
        <WidgetSm />
        <WidgetLg />
      </div> */}
      <Chart data={hostData} title="Hosts Analytics" grid dataKey="Hosts" />
      <Chart data={addressData} title="Addresses Analytics" grid dataKey="Addresses" />
      <Chart data={groupsData} title="Groups Analytics" grid dataKey="Groups" />
      <Chart data={blogsData} title="Blogs Analytics" grid dataKey="Blogs" />
    </div>
  );
}
