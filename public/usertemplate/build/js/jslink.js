const { createRoot } = ReactDOM;
const {  Pagination  } = antd;
const {  useState  } = React;;
const App = () => {
  const [current, setCurrent] = useState(3);
  const onChange = (page) => {
    console.log(page);
    setCurrent(page);
  };
  return <Pagination current={current} onChange={onChange} total={50} />;
};
const ComponentDemo = App;


createRoot(mountNode).render(<ComponentDemo />);
