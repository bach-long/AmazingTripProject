
import { Fragment } from 'react';
import { BrowserRouter as Router, Routes, Route } from 'react-router-dom';
import { ToastContainer } from 'react-toastify';
import { publicRoutes, privateRoutes } from './router';
import { DefaultLayout } from './components/Layouts';
import RequireAuth from './components/RequireAuth';
import getCookie from './hooks/getCookie';
import "slick-carousel/slick/slick.css"; 
import "slick-carousel/slick/slick-theme.css";

function App() {
  // const [userList, setUserList] = useState([]);

  // useEffect(() => {
  //   const fectchUserList = async () => {
  //     try {
  //       const response = await userApi.getAll();
  //       console.log(response);
  //     } catch (error) {
  //       console.log('Toang meo chay roi loi cc: ', error);
  //     }

  //   }

  //   fectchUserList();
  // }, []);

  return (

    <Router>
      <div className="App">
        <ToastContainer autoClose={2000} style={{ fontSize: '16px' }}/>
        <Routes>
        { publicRoutes.map((route, index) => {
              const Layout = route.layout || DefaultLayout;
              const Page = route.component;
              const Provider = route.provider || Fragment;
              return (
                <Route 
                  key={index} 
                  path={route.path} 
                  element={
                    <Provider>
                      <Layout>
                        <Page />
                      </Layout>
                    </Provider>
                  } 
                />
              );
            })}
          <Route element={<RequireAuth />}>
            { privateRoutes.map((route, index) => {
              const Layout = route.layout || DefaultLayout;
              const Page = route.component;
              const Provider = route.provider || Fragment;
              return (
                <Route 
                  key={index} 
                  path={route.path} 
                  element={
                    <Provider>
                      <Layout>
                        <Page />
                      </Layout>
                    </Provider>
                  } 
                />
              );
            })}
          </Route>
        </Routes>
      </div>
    </Router>
  );
}

export default App;