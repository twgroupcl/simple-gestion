<html>
    <body>
        <p>La orden #{{ $order->id }} no pudo ser enviada a los sistemas de Covepa.</p>

        @if ($apiResponse)
        <p>Respuesta de la api: {{ $apiResponse }}</p>    
        @endif

        @if ($e)
        <p>Exception: {{ $e->getMessage() }}</p>
        @endif

        @if ($jsonData)
        <p>Json Data: {{ $jsonData }}</p>
        @endif
    </body>
</html>