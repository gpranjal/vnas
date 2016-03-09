
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>


    <script src="http://code.jquery.com/jquery-1.10.2.js"></script>
    <script src="http://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
<style>
    .search{
        background-position: -160px -112px;
    }
</style>
    <div id="search_patient" class="row">

        <label for="patient_search">Patient: </label>
        <input class="search ui-autocomplete-input" type="text" size="25" maxlength="50" id="patient_search" name="patient_search">

    </div>

  <script>


      $(function() {
          $( "#patient_search" ).autocomplete({
                      source: function (request, response) {
                          $.getJSON("/search_patient", function (data) {
                              response($.map(data, function (value, key) {
                                  return {
                                      label: value +", id: "+ key,
                                      value: key
                                  };
                              }));
                          });
                      },
              minLength: 2,
              delay: 500,
                  select: function(event, ui) {





//
                  }})
      });
  </script>

