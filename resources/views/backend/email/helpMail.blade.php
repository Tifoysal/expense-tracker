<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> BossSend Helpline </title>
    <!-- Include Tailwind CSS styles inline -->
    <style>
        /* Tailwind CSS classes */
        .bg-green-500 { background-color: #38A169; }
        .text-white { color: #ffffff; }
        .py-4 { padding-top: 1rem; padding-bottom: 1rem; }
        .text-lg { font-size: 1.125rem; }
        .text-center { text-align: center; }
    </style>
</head>
<body>
    <table class="w-full">
        <tr>
            <td class="py-4 bg-green-500 text-white text-lg text-center">
                Helpline
            </td>
        </tr>
        <tr>
            <td class="py-4">
                <p>Dear BossSend,</p>
                <p> Subject : {{$data->subject}}</p>
                <p>{{$data->message}}</p>
                <p></p>
                <br>
                <p>Sincerely</p>
                <p>{{$data->name}}</p>
                <p>{{$data->email}}</p>
              
            </td>
        </tr>
    </table>
</body>
</html>
