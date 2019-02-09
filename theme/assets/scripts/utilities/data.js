const DataJs = ({ element, context = document, all = false }) => {
  if (all) {
    return context.querySelectorAll(`[data-js="${element}"]`);
  } else {
    return context.querySelector(`[data-js="${element}"]`);
  }
}

export default DataJs;
