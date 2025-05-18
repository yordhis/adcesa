async function getPlan(codigo){
    return await  fetch(URL_BASE_API + "/plan/" + codigo)
          .then((response) => response.json())
          .then((res) => res)
          .catch((err) => err);
}

async function createCuotas( data ){
    return await fetch( URL_BASE_API + "/createCuotas", {      
        method: "POST", // or 'PUT'
        body: JSON.stringify(data), // data can be `string` or {object}!
        headers: {
          "Content-Type": "application/json",
        },
    })
    .then(response => response.json())
    .then(data => data)
    .catch(err => err)
};