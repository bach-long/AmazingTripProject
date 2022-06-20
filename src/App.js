
import './Test.scss';
import BlogAddress from './component/BlogAddress';

function App() {
  return (
    <div id="main-content">
      <div className="row">
        <div className="col-sm-2">Menu left</div>
        <BlogAddress />
        <div className="col-sm-2">Menu right</div>
      </div>
    </div>
  );
}

export default App;
