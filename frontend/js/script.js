$(document).ready(function () {
  $('.Details').hide();
  $('.newApp').hide();
  getAppointments();
  $('.list-group').on('click', '.list-group-item', function () {
    showDetails(this);
  });
  $('#appointment-form').on('submit', function (event) {
    event.preventDefault();
    saveToDatabase();
  });
  $('#del-btn').on('click', function () {
    let appId = parseInt($("#detail-id").text());
    deleteData("deleteAppointment", appId);
  });
});

const addOptionBtn = document.querySelector("#add-option-btn");
const form = document.querySelector("#appointment-form");

function createTimeslotInHtml() {
  const newInput = document.createElement("div");
  newInput.innerHTML = `
    <div class="row" id="option-row">
      <div class="input-box col">
        <input type="datetime-local" id="option-start" name="option-start" required>
      </div>
      <div class="input-box col">
        <input type="datetime-local" id="option-end" name="option-end" required>
      </div>
    </div>
  `;
  form.insertBefore(newInput, addOptionBtn);
}

function showDetails(element) {
  var appointmentId = $(element).data('id');
  if (appointmentId != null) {
    $.ajax({
      type: "POST",
      url: "../backend/serviceHandler.php",
      cache: false,
      data: { method: "queryAppointmentById", param: appointmentId },
      dataType: "json",
      success: function (response) {
        addOptionToDetails(appointmentId);
        Votes(appointmentId);
        var appointment = response[0];
        $('#detail-id').append(appointment.id);
        $('#detail-name').append(appointment.name);
        $('#detail-location').append(appointment.location);
        $('#detail-description').append(appointment.description);
        $('#detail-start').append(appointment.vote_start);
        $('#detail-end').append(appointment.vote_end);
        $('#detail-creator').append(appointment.creator);
        $('.wrapper > .h2').hide();
        $('.list-group').hide();
        $('.Details').show();
        if ($('.mylistitem[data-id="' + appointmentId + '"]').hasClass('over')) {
          $('form input').prop('disabled', true);
          $('form button').prop('disabled', true);
        }
        loadComments();
      },
      error: function (err) {
        console.log(err);
      }
    });
  }
}

function Votes(id) {
  $.ajax({
    type: "GET",
    url: "../backend/serviceHandler.php",
    cache: false,
    data: { method: "queryAppointmentVotes", param: id },
    dataType: "json",
    success: function (response) { },
    error: function (err) {
      console.log(err);
    }
  });
}

function addOptionToDetails(id) {
  $.ajax({
    type: "POST",
    url: "../backend/serviceHandler.php",
    cache: false,
    data: { method: "queryAppointmentOptions", param: id },
    dataType: "json",
    success: function (response) {
      var options = response;
      var optionDiv = $('<div>').addClass('option-div');
      $.each(options, function (i, option) {
        var start = option.start;
        var end = option.end;
        var id = option.optionId;
        var optionItem = $('<div>').addClass('form-check');
        var label = $('<label>').addClass('form-check-label').text(start + ' to ' + end);
        var input = $('<input>').addClass('form-check-input').attr({
          "data-optid": option.optionId,
          type: 'checkbox',
          name: 'option',
          value: start + ' to ' + end,
          'data-id': id,
        });
        optionItem.append(input).append(label);
        optionDiv.append(optionItem);
      });
      $('.appointment.option').html('<h3>Vote on Option</h3>');
      $('.appointment.option').append(optionDiv);
    },
    error: function (err) {
      console.log(err);
    }
  });
}

$('#add-app-link').on('click', function () {
  $('.wrapper > .h2').hide();
  $('.list-group').hide();
  $('.Details').hide();
  $('.newApp').show();
});

function saveToDatabase() {
  var name = document.getElementById('name').value;
  var location = document.getElementById('location').value;
  var description = document.getElementById('description').value;
  var start = document.getElementById('start').value;
  var end = document.getElementById('end').value;
  var creator = document.getElementById('creator').value;

  var data = {
    ap_name: name,
    location: location,
    description: description,
    vote_start: start,
    vote_end: end,
    creator_name: creator,
  };
  $.ajax({
    type: "POST",
    url: "../backend/serviceHandler.php",
    cache: false,
    data: { method: "createNewAppointment", param: data },
    dataType: "json",
    success: function (response) {
      var apId = response[1];
      saveOptions(apId);
      alert("Created Appointment");
      window.location.reload();
    },
    error: function (err) {
      console.log(err);
    }
  });
}

function voting() {
  var appointmentId = parseInt($('#detail-id').text());
  var name = $('#voter').val();
  var selectedOptions = [];

  $('input[name="option"]:checked').each(function () {
    selectedOptions.push($(this).data('id'));
  });

  if (selectedOptions.length > 0) {
    var completedRequests = 0;
    var totalRequests = selectedOptions.length;

    selectedOptions.forEach(function (optionId) {
      var data = {
        ap_id: appointmentId,
        op_id: optionId,
        voter_name: name
      };

      $.ajax({
        type: "POST",
        url: "../backend/serviceHandler.php",
        cache: false,
        data: { method: "createNewVoting", param: data },
        dataType: "json",
        success: function (response) {
          alert("Voting successfull");
          console.log(response);
          completedRequests++;
          if (completedRequests === totalRequests) {
            comment();
          }
        },
        error: function (err) {
          console.log(err);
          alert("Error occurred while voting. Please try again later.");
        }
      });
    });
  } else {
    alert("You have not chosen an option. If this was a mistake, please choose one.");
  }

  $("#voter").val("");
}

function saveOptions(apId) {
  let rows = document.querySelectorAll("#option-row");
  rows.forEach(function (row) {
    let startOp = row.querySelector("#option-start").value;
    let endOp = row.querySelector("#option-end").value;
    const data = {
      ap_id: apId,
      op_start: startOp,
      op_end: endOp,
    };
    $.ajax({
      type: "POST",
      url: "../backend/serviceHandler.php",
      cache: false,
      data: { method: "createNewOption", param: data },
      dataType: "json",
      success: function (response) {
        console.log(response);
      },
      error: function (err) {
        console.log(response);
      }
    });
  });
}

function getAppointments() {
  $.ajax({
    type: "POST",
    url: "../backend/serviceHandler.php",
    cache: false,
    data: { method: "queryAppointments" },
    dataType: "json",
    success: function (response) {
      var appointments = response;
      var listGroup = $('.list-group');
      var currentDate = new Date();
      $.each(appointments, function (i, appointment) {
        var listItem = $('<a>').attr({
          href: '#',
          class: 'list-group-item list-group-item-action mylistitem' + (currentDate > new Date(appointment.vote_end) ? ' over' : ''),
          'data-id': appointment.id,
        }).text(appointment.name);

        listGroup.append(listItem);
      });
    },
    error: function (err) {
      console.log(err);
    }
  });
}

function loadData(searchMethod, searchTerm, itemType) {
  $.ajax({
    type: "GET",
    url: "../backend/serviceHandler.php",
    cache: false,
    data: { method: searchMethod, param: searchTerm },
    dataType: "json",
    success: function (response) {
      response.forEach(el => {
        if (el) {
          console.log(el);
          $("#container").append($("<p>").text(`${itemType}(id=${el.id}, ${el}`));
        }
      });
    }
  });
}

function writeData(searchMethod, searchTerm) {
  $.ajax({
    type: "POST",
    url: "../backend/serviceHandler.php",
    cache: false,
    data: { method: searchMethod, param: searchTerm },
    dataType: "json",
    success: function (response) { },
    error: function (err) {
      console.log(err);
    }
  });
}

function deleteData(searchMethod, searchTerm) {
  $.ajax({
    type: "DELETE",
    url: "../backend/serviceHandler.php",
    cache: false,
    data: { method: searchMethod, param: searchTerm },
    dataType: "json",
    success: function (response) {
      window.location.replace("index.html");
    },
    error: function (err) {
      console.log(err);
    }
  });
}

function loadComments() {
  let appId = parseInt($("#detail-id").text());
  $.ajax({
    type: "GET",
    url: "../backend/serviceHandler.php",
    cache: false,
    data: { method: "queryAppointmentComments", param: appId },
    dataType: "json",
    success: function (response) {
      $("#list-comments").children().remove();
      response.forEach(el => {
        if (el) {
          $("#list-comments").append($("<p>")).append($("<strong>").text(el.author + ": ")).append($("<span>").text(el.text));
        }
      });
    }
  });
}

function comment() {
  let appId = parseInt($("#detail-id").text());
  let voterName = $("#voter").val();
  let commentText = $("#voter-comment").val();
  let votes = $("input:checked").toArray();
  if (commentText != "" && voterName != "") {
    $.ajax({
      type: "POST",
      url: "../backend/serviceHandler.php",
      cache: false,
      data: { method: "createNewComment", param: { "ap_id": appId, "author_name": voterName, "comment_text": commentText } },
      dataType: "json",
      success: function (response) {
        alert("Commeting Successfull");
        loadComments();
      },
      error: function (err) {
        console.log(err);
      }
    });
  }
  $("#voter-comment").val("");
}
