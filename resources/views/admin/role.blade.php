
    <script src="https://code.jquery.com/jquery-1.10.2.js"></script>
    <script src="https://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
<style>
    .search{
        background-position: -160px -112px;
    }
</style>

<label>{{$role_id->name}}</label>
<form id="assign_roles" class="form-horizontal" role="form" method="POST" action="{{url('/role_update')}}/{{$role_id->id}}">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <table class="table" style="width:100%">
        <tr>
            <td>Patient ID: {{$role_id->patient_role}}</td>
            <td><input class="search ui-autocomplete-input" type="text" size="25" maxlength="50" id="patient_search" name="patient_search"></td>

        </tr>
        <tr>
            <td>Caregiver ID</td>
            <td><input class="search ui-autocomplete-input" type="text" size="25" maxlength="50" id="caregiver_search" name="caregiver_search"></td>

        </tr>
    </table>
    <input type="submit" value="submit">
</form>
    {{--<div id="search_patient" class="row">--}}


        {{--<label for="patient_search">Patient: </label>--}}
        {{--<input class="search ui-autocomplete-input" type="text" size="25" maxlength="50" id="patient_search" name="patient_search">--}}

    {{--</div>--}}

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

