<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    

    <title>Access Export</title>
</head>
<body>
    <div class="">
        <h1>Access ROOM 911</h1>
        <hr>
        <table class="table table-striped " >
            <thead>
              <tr style="border: 1px solid; padding: 2px;">
                <th scope="col">Employee ID</th>
                <th scope="col">Time</th>
                <th scope="col">First Name</th>
                <th scope="col">Last Name</th>
                <th scope="col">Departament</th>
                <th scope="col">Access</th>
              </tr>
            </thead>
            <tbody>
                @foreach($access as $ac)
                    <tr style="padding: 2px;">
                        <th scope="row" style="padding: 4px 6px; margin: 4px 4px;">{{$ac->employee}}</th>
                        <th style="padding: 4px 6px; margin: 4px 4px;">{{$ac->datetime}}</th>
                        <td style="padding: 4px 6px; margin: 4px 4px;">{{strtoupper($ac->employeeObject->firstname ?? 'No register')}}</td>
                        <td style="padding: 4px 6px; margin: 4px 4px;">{{strtoupper($ac->employeeObject->lastname ?? 'No register')}}</td>
                        <td style="padding: 4px 6px; margin: 4px 4px;">{{strtoupper($ac->employeeObject->departament->name ?? 'No register')}}</td>
                        
                        <td>{{strtoupper($ac->canAccess ? 'yes':'no')}}</td>
                    </tr>
                @endforeach             
            </tbody>
          </table>
    </div>
</body>
</html>