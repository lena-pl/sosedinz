$(function () {
  var tags = []
  if (inputTags !== "") {
    tags = inputTags.split(',');
  }

  new Taggle("tags", {
    tags: tags,
    hiddenInputName: 'tags[]'
  })
});
