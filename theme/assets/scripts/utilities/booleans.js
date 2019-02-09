const Booleanify = (value) => {
  let returnVal;
  value === "false" ? returnVal = false : returnVal = true;
  return returnVal;
}

export default Booleanify;
