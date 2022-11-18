let liked = false;

const onLike = async (id) => {
  const action = liked ? "remove" : "add";

  liked = !liked;

  const color = liked ? "red" : "currentColor";
  const res = await fetch(`${APP_URL}product/like/${id}/${action}`);
  const data = await res.json();

  if (data.error) {
    return Swal.fire({
      title: "Ops!",
      text: "Algo salió mal :(",
      icon: "error",
    });
  }

  document.getElementById("total-likes").innerHTML = data.current_likes;
  document.getElementById("heart").setAttribute("fill", color);
};
