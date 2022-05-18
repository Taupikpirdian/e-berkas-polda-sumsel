// toastr.error("Jatuh Tempo", "Notification");
// toastr.success("Item di Acc", "Acc Item");

// notification data on dashboard
$(document).ready(function () {
  // counting data
  setInterval(function getCountDataNotif() {
    $.ajax({
      url: "/notification/count",
      method: "GET",
      success: function (data) {
        var element = document.getElementById("bell_beep");
        if (data != 0) {
          $('#amount_count').html(data);
          element.classList.add("pulse");
        }else{
          $('#amount_count').html(data);
          element.classList.remove("pulse");
        }
      }
    });
    return getCountDataNotif;
  }(), 60000); // setiap 1 menit refresh data

  // list notification (on navbar)
  setInterval(function getDataNotif() {
    $.ajax({
      url: "/notification/list-data",
      type: "GET",
      data: { "_token": "{{ csrf_token() }}" },
      success: function (data) {
        $(".content__notifikasi").empty();
        $.each(JSON.parse(data), function (index, value) {
          var perkara_id = value.data_id;
          
          fetch('/called/helper-encrpt/'+perkara_id)
            .then((response) => {
              return response.json();
            })
            .then((myJson) => {

              var idEncrypt = "'" + myJson + "'";
              var notif_type = value.notif_type;
              let message = value.message;
              $(".content__notifikasi").append(
                '<a class="dropdown-item d-flex" onclick="authPinNotif('+idEncrypt+','+notif_type+')">' +
                    '<div class="me-3 notifyimg bg-secondary-gradient brround box-shadow-primary">' +
                        '<i class="fa fa-bell"></i>' +
                    '</div>' +
                    '<div class="mt-1">' +
                        '<h5 class="notification-label mb-1">'+ message +'</h5>' +
                        '<span class="notification-subtext">' + value.age_of_data + '</span>' +
                    '</div>' +
                '</a>'
              );

            });

        });
      }
    });
    return getDataNotif;
  }(), 60000); // setiap 1 menit refresh refresh data

  // toastr js
  setInterval(function getDataNotif() {
    $.ajax({
      url: "/notification/list-data-for-toastr",
      type: "GET",
      data: { "_token": "{{ csrf_token() }}" },
      success: function (data) {
        $.each(JSON.parse(data), function (index, value) {
          var id = value.id;
          let message = value.message;
          // condition
          toastr.success(message, 'Notification');
        });
      }
    });
    return getDataNotif;
  }(), 60000); // setiap 1 menit refresh refresh data
});