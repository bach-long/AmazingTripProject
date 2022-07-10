import Sidebar from "./components/sidebar/Sidebar";
import Topbar from "./components/topbar/Topbar";
import "./App.css";
import Home from "./pages/home/Home";
import { BrowserRouter as Router, Switch, Route } from "react-router-dom";
import UserList from "./pages/userList/UserList";
import HostList from "./pages/hostList/HostList";
import AddressList from "./pages/addressList/AddressList";
import User from "./pages/user/User";
import NewUser from "./pages/newUser/NewUser";
import ProductList from "./pages/productList/ProductList";
import Product from "./pages/product/Product";
import NewProduct from "./pages/newProduct/NewProduct";
import GroupList from "./pages/groupList/GroupList";
import BlogList from "./pages/blogList/BlogList";
import BlogAddressList from "./pages/blogAddressList/BlogAddressList";

function App() {
  return (
    <Router>
      {/* <Topbar /> */}
      <div className="container">
        <Sidebar />
        <Switch>
          <Route exact path="/">
            <Home />
          </Route>
          <Route path="/users">
            <UserList />
          </Route>
          <Route path="/hosts">
            <HostList />
          </Route>
          <Route path="/addresses">
            <AddressList />
          </Route>
          <Route path="/groups">
            <GroupList />
          </Route>
          <Route path="/blogs">
            <BlogList />
          </Route>
          <Route path="/blogAddresses">
            <BlogAddressList />
          </Route>
          <Route path="/user/:userId">
            <User />
          </Route>
          <Route path="/newUser">
            <NewUser />
          </Route>
          <Route path="/products">
            <ProductList />
          </Route>
          <Route path="/product/:productId">
            <Product />
          </Route>
          <Route path="/newproduct">
            <NewProduct />
          </Route>
        </Switch>
      </div>
    </Router>
  );
}

export default App;
