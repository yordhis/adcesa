async function getGrupo(codigo){
      return await  fetch(URL_BASE_API + "/grupo/" + codigo)
            .then((response) => response.json())
            .then((res) => res)
            .catch((err) => err);
}