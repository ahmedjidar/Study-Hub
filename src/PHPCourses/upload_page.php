<?php
// upload_page.php
include '../PHPAuth/config.php';

$courseId = filter_input(INPUT_GET, 'course-id', FILTER_SANITIZE_NUMBER_INT);
?>
<link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
<div class="container mx-auto px-4">
    <form id="upload-form" class="mt-8 max-w-md">
        <input type="hidden" name="course-id" value="<?php echo $courseId; ?>">
        <div class="flex items-center justify-between py-5">
            <label class="w-64 flex flex-col items-center px-4 py-6 bg-white text-blue rounded-lg shadow-lg tracking-wide uppercase border border-blue cursor-pointer hover:bg-blue hover:text-white">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 10.5v6m3-3H9m4.06-7.19-2.12-2.12a1.5 1.5 0 0 0-1.061-.44H4.5A2.25 2.25 0 0 0 2.25 6v12a2.25 2.25 0 0 0 2.25 2.25h15A2.25 2.25 0 0 0 21.75 18V9a2.25 2.25 0 0 0-2.25-2.25h-5.379a1.5 1.5 0 0 1-1.06-.44Z" />
                </svg>
                <span class="mt-2 text-base leading-normal">Select a file</span>
                <input type='file' class="hidden" name="file" />
            </label>
            <input type="button" id="upload-button" value="Upload File" class="cursor-pointer bg-purple-500 hover:bg-purple-700 text-white font-bold py-2 px-4 rounded-xl">
        </div>
    </form>

    <div id="files">
    <?php
    $dir = "../uploads/$courseId";
    if (is_dir($dir)) {
        $files = scandir($dir);
        echo '<div class="grid grid-cols-3 gap-4 mt-8">';
        foreach ($files as $file) {
            if ($file != '.' && $file != '..') {
                $filePath = $dir . '/' . $file;
                $fileModTime = date("F d Y H:i:s.", filemtime($filePath));
                echo '
                    <div class="flex flex-col items-center text-center bg-white p-4 shadow rounded-lg">
                        <img src="../StaticCourses/learning.png" alt="File Icon" class="w-16 h-16 mx-auto mb-4">
                        <a href="' . $filePath . '" class="text-lg font-semibold text-gray-900 mb-2">' . $file . '</a>
                        <a href="' . $filePath . '" download class="text-blue-500 hover:underline">Download</a>
                        <span class="text-sm text-gray-600">Uploaded on ' . $fileModTime . '</span>
                    </div>
                ';
            }
        }
        echo '</div>';
    }
    ?>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
$('#upload-button').click(function() {
    var formData = new FormData($('#upload-form')[0]);
    $.ajax({
        url: '../PHPCourses/upload.php',
        type: 'POST',
        data: formData,
        success: function(data) {
            var response = JSON.parse(data);
            if (response.status == 'success') {
                var fileHtml = '<div class="flex flex-col items-center text-center bg-white p-4 shadow rounded-lg mt-4 bg-purple-300 shadow-sm animate-pulse">' +
                    '<img src="../StaticCourses/learning.png" alt="File Icon" class="w-16 h-16 mx-auto mb-4">' +
                    '<a href="' + response.filePath + '" class="text-lg font-semibold text-gray-900 mb-2">' + response.fileName + '</a>' +
                    '<a href="' + response.filePath + '" download class="text-blue-500 hover:underline">Download</a>' +
                    '<span class="text-sm text-gray-600">Uploaded on ' + response.fileModTime + '</span>' +
                    '</div>';
                $('#files').append(fileHtml);
            } else {
                alert(response.message);
            }
        },
        cache: false,
        contentType: false,
        processData: false
    });
    return false;
});
</script>
