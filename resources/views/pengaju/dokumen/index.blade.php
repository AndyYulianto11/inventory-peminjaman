<!DOCTYPE html>
<html>

<head>
    <title>Preview File</title>
</head>

<body>
    <?php
    $url = $datapengaju->upload_dokumen;
    $fixedUrl = preg_replace('/public+/', '', $url);
    ?>

    <embed src="{{ asset('storage/' . $fixedUrl) }}" type="application/pdf" width="100%"
        height="700px" />
</body>

</html>
