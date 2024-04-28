<?php
session_start();

if(!isset($_SESSION['username'])){
    header("Location: login.php"); 
    exit;
}

?>

<p class="text-sm text-gray-400 mt-6 mb-2">Settings for you, <span class="underline"><?php echo $_SESSION['username'] ?></span></p>
<div class="flex flex-col gap-4 shadow-md p-4 rounded-2xl">
    <section class="bg-white p-6 shadow rounded">
        <div class="bg-gray-200 pt-5 px-20 rounded inline-block"></div>
        <div class="border mb-5 mt-4"></div>
        <div class="bg-gray-200 pt-3 rounded max-w-lg mb-3"></div>
        <div class="bg-gray-100 pt-3 rounded max-w-sm"></div>
    </section>
    <section class="bg-white p-6 shadow rounded flex flex-col gap-10">
        <div class="flex gap-6 items-start">
            <div class="p-5 bg-gray-200 inline-block rounded-full"></div>
            <div class="w-full flex flex-col items-start gap-3">
                <div class="bg-gray-200 pt-3 px-14 rounded"></div>
                <div class="bg-gray-200 pt-3 rounded w-full max-w-xs"></div>
                <div class="bg-gray-100 pt-3 rounded w-full max-w-md"></div>
            </div>
        </div>

        <div class="flex gap-6 items-start">
            <div class="p-5 bg-gray-200 inline-block rounded-full"></div>
            <div class="w-full flex flex-col items-start gap-3">
                <div class="bg-gray-200 pt-3 px-14 rounded"></div>
                <div class="bg-gray-200 pt-3 rounded w-full max-w-lg"></div>
                <div class="bg-gray-100 pt-3 rounded w-full max-w-md"></div>
            </div>
        </div>

        <div class="flex gap-6 items-start">
            <div class="p-5 bg-gray-200 inline-block rounded-full"></div>
            <div class="w-full flex flex-col items-start gap-3">
                <div class="bg-gray-200 pt-3 px-14 rounded"></div>
                <div class="bg-gray-200 pt-3 rounded w-full max-w-md"></div>
                <div class="bg-gray-100 pt-3 rounded w-full max-w-lg"></div>
            </div>
        </div>
    </section>
    <section class="bg-white p-6 shadow rounded flex flex-col gap-10">
        <div class="flex gap-6 items-start">
            <div class="p-5 bg-gray-200 inline-block rounded-full"></div>
            <div class="w-full flex flex-col items-start gap-3">
                <div class="bg-gray-200 pt-3 px-14 rounded"></div>
                <div class="bg-gray-200 pt-3 rounded w-full max-w-xs"></div>
                <div class="bg-gray-100 pt-3 rounded w-full max-w-md"></div>
            </div>
        </div>

        <div class="flex gap-6 items-start">
            <div class="p-5 bg-gray-200 inline-block rounded-full"></div>
            <div class="w-full flex flex-col items-start gap-3">
                <div class="bg-gray-200 pt-3 px-14 rounded"></div>
                <div class="bg-gray-200 pt-3 rounded w-full max-w-lg"></div>
                <div class="bg-gray-100 pt-3 rounded w-full max-w-md"></div>
            </div>
        </div>

        <div class="flex gap-6 items-start">
            <div class="p-5 bg-gray-200 inline-block rounded-full"></div>
            <div class="w-full flex flex-col items-start gap-3">
                <div class="bg-gray-200 pt-3 px-14 rounded"></div>
                <div class="bg-gray-200 pt-3 rounded w-full max-w-md"></div>
                <div class="bg-gray-100 pt-3 rounded w-full max-w-lg"></div>
            </div>
        </div>
    </section>
</div>     
