class search {
  submit(form) {
    const input = form.querySelector('input');
    $.ajax({
      crossOrigin: true,
      type: 'POST',
      url: '../search',
      data: { searchBy: input.value },
      success: function (data) {
        console.log(data);
      },
      error: function (request, status, error) {
        alert(
          'code:' +
            request.status +
            '\n' +
            'message:' +
            request.responseText +
            '\n' +
            'error:' +
            error
        );
      }
    });
  }
}

export { search };
