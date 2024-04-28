<?php
session_start();

if(!isset($_SESSION['username'])){
    header("Location: login.php"); 
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
    <title>Meditation</title>
</head>
<body>
    <div class="flex items-center justify-center mt-8">
        <div x-data="{ slide: 0, intervalId: null, time: 15 * 60 }" class="" role="region" aria-roledescription="carousel">
            <div class="overflow-hidden ">
                <div 
                    class="flex w-96"
                    x-bind:style="'transform: translate3d(' + (-slide * 100) + '%, 0px, 0px); transition: transform 0.5s;'"
                >
                    <!-- Slide 1 -->
                    <div role="group" aria-roledescription="slide" class="pl-4 min-w-full">
                        <div class="bg-white rounded-lg shadow-md p-6">
                        <div class="text-lg font-semibold">Step 1/9</div>
                        <blockquote class="mt-4 text-sm italic text-gray-600">
                            “Brilliant things happen in calm minds. Be calm. You're brilliant”
                        </blockquote>
                        <img
                            src="../StaticMeditation/assets/MeditationImage.png"
                            alt="Meditation illustration"
                            class="w-full h-auto object-cover my-4 shadow-md rounded-2xl"
                        />
                        <div class="text-center text-sm text-gray-500" x-text="Math.floor(time / 60) + ':' + ('0' + time % 60).slice(-2)">15:00</div>
                        <button 
                            id="startMeditationId"
                            class="items-center hover:bg-purple-800 justify-center whitespace-nowrap rounded-md text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 hover:bg-primary/90 h-10 px-4 py-2 w-full mt-4 bg-purple-600 text-white"
                            onclick="startMeditation()"
                            >
                            Start Meditation Now 
                        </button>
                        </div>
                    </div>
                    <!-- Slide 2 -->
                    <div role="group" aria-roledescription="slide" class="pl-4 min-w-full">
                        <div class="bg-white rounded-lg shadow-md p-6">
                        <div class="text-lg font-semibold">Step 2/9</div>
                        <blockquote class="mt-4 text-sm italic text-gray-600">
                        “The journey of a thousand miles begins with one step.” - Lao Tzu
                        </blockquote>
                        <img
                            src="../StaticMeditation/assets/M1.jpg"
                            alt="Meditation illustration"
                            class="w-full h-auto object-cover my-4 shadow-md rounded-2xl"
                        />
                        <div 
                            class="text-center text-sm text-gray-500"
                            x-text="Math.floor(time / 60) + ':' + ('0' + time % 60).slice(-2)"    
                        >
                            15:00
                        </div>
                        </div>
                    </div>
                    <!-- Slide 3 -->
                    <div role="group" aria-roledescription="slide" class="pl-4 min-w-full">
                        <div class="bg-white rounded-lg shadow-md p-6">
                        <div class="text-lg font-semibold">Step 3/9</div>
                        <blockquote class="mt-4 text-sm italic text-gray-600">
                        “The mind is everything. What you think you become.” - Buddha
                        </blockquote>
                        <img
                            src="../StaticMeditation/assets/M2.jpg"
                            alt="Meditation illustration"
                            class="my-4 w-full shadow-md rounded-2xl"
                            width="300"
                            height="300"
                            style="aspect-ratio: 300 / 300; object-fit: cover;"
                        />
                        <div class="text-center text-sm text-gray-500" x-text="Math.floor(time / 60) + ':' + ('0' + time % 60).slice(-2)">15:00</div>
                        </div>
                    </div>
                    <!-- slide 4  -->
                    <div role="group" aria-roledescription="slide" class="pl-4 min-w-full">
                        <div class="bg-white rounded-lg shadow-md p-6">
                        <div class="text-lg font-semibold">Step 4/9</div>
                        <blockquote class="mt-4 text-sm italic text-gray-600">
                        “Peace comes from within. Do not seek it without.” - Buddha
                        </blockquote>
                        <img
                            src="../StaticMeditation/assets/M3.jpg"
                            alt="Meditation illustration"
                            class="my-4 w-full shadow-md rounded-2xl"
                            width="300"
                            height="300"
                            style="aspect-ratio: 300 / 300; object-fit: cover;"
                        />
                        <div class="text-center text-sm text-gray-500" x-text="Math.floor(time / 60) + ':' + ('0' + time % 60).slice(-2)">15:00</div>
                        </div>
                    </div>
                    <!-- slide 5 -->
                    <div role="group" aria-roledescription="slide" class="pl-4 min-w-full">
                        <div class="bg-white rounded-lg shadow-md p-6">
                        <div class="text-lg font-semibold">Step 5/9</div>
                        <blockquote class="mt-4 text-sm italic text-gray-600">
                        “With our thoughts, we make the world.” - Buddha
                        </blockquote>
                        <img
                            src="../StaticMeditation/assets/M4.png"
                            alt="Meditation illustration"
                            class="my-4 w-full shadow-md rounded-2xl"
                            width="300"
                            height="300"
                            style="aspect-ratio: 300 / 300; object-fit: cover;"
                        />
                        <div class="text-center text-sm text-gray-500" x-text="Math.floor(time / 60) + ':' + ('0' + time % 60).slice(-2)">15:00</div>
                        </div>
                    </div>
                    <!-- slide 6  -->
                    <div role="group" aria-roledescription="slide" class="pl-4 min-w-full">
                        <div class="bg-white rounded-lg shadow-md p-6">
                        <div class="text-lg font-semibold">Step 6/9</div>
                        <blockquote class="mt-4 text-sm italic text-gray-600">
                        “Do not dwell in the past, do not dream of the future, concentrate the mind on the present moment.” - Buddha
                        </blockquote>
                        <img
                            src="../StaticMeditation/assets/M1.jpg"
                            alt="Meditation illustration"
                            class="my-4 w-full shadow-md rounded-2xl"
                            width="300"
                            height="300"
                            style="aspect-ratio: 300 / 300; object-fit: cover;"
                        />
                        <div class="text-center text-sm text-gray-500" x-text="Math.floor(time / 60) + ':' + ('0' + time % 60).slice(-2)">15:00</div>
                        </div>
                    </div>
                    <!-- slide 7 -->
                    <div role="group" aria-roledescription="slide" class="pl-4 min-w-full">
                        <div class="bg-white rounded-lg shadow-md p-6">
                        <div class="text-lg font-semibold">Step 7/9</div>
                        <blockquote class="mt-4 text-sm italic text-gray-600">
                        “The best way to capture moments is to pay attention. This is how we cultivate mindfulness.” - Jon Kabat-Zinn
                        </blockquote>
                        <img
                            src="../StaticMeditation/assets/M2.jpg"
                            alt="Meditation illustration"
                            class="my-4 w-full shadow-md rounded-2xl"
                            width="300"
                            height="300"
                            style="aspect-ratio: 300 / 300; object-fit: cover;"
                        />
                        <div class="text-center text-sm text-gray-500" x-text="Math.floor(time / 60) + ':' + ('0' + time % 60).slice(-2)">15:00</div>
                        </div>
                    </div>
                    <!-- slide 8 -->
                    <div role="group" aria-roledescription="slide" class="pl-4 min-w-full">
                        <div class="bg-white rounded-lg shadow-md p-6">
                        <div class="text-lg font-semibold">Step 8/9</div>
                        <blockquote class="mt-4 text-sm italic text-gray-600">
                        “In the midst of movement and chaos, keep stillness inside of you.” - Deepak Chopra
                        </blockquote>
                        <img
                            src="../StaticMeditation/assets/M3.jpg"
                            alt="Meditation illustration"
                            class="my-4 w-full shadow-md rounded-2xl"
                            width="300"
                            height="300"
                            style="aspect-ratio: 300 / 300; object-fit: cover;"
                        />
                        <div class="text-center text-sm text-gray-500" x-text="Math.floor(time / 60) + ':' + ('0' + time % 60).slice(-2)">15:00</div>
                        </div>
                    </div>
                    <!-- slide 9 -->
                    <div role="group" aria-roledescription="slide" class="pl-4 min-w-full">
                        <div class="bg-white rounded-lg shadow-md p-6">
                        <div class="text-lg font-semibold">Step 9/9</div>
                        <blockquote class="mt-4 text-sm italic text-gray-600">
                        “The soul always knows what to do to heal itself. The challenge is to silence the mind.” - Caroline Myss                        </blockquote>
                        <img
                            src="../StaticMeditation/assets/M4.png"
                            alt="Meditation illustration"
                            class="my-4 w-full shadow-md rounded-2xl"
                            width="300"
                            height="300"
                            style="aspect-ratio: 300 / 300; object-fit: cover;"
                        />
                        <div class="text-center text-sm text-gray-500" x-text="Math.floor(time / 60) + ':' + ('0' + time % 60).slice(-2)">15:00</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="flex items-center justify-center">
                <button
                    id="stopMeditationId"
                    x-text="`Stop Meditation: ${Math.floor(time / 60)}:${('0' + time % 60).slice(-2)}`"
                    onclick="stopMeditation()"
                    class="hidden items-center hover:bg-gray-700 justify-center whitespace-nowrap rounded-md text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 h-10 px-4 py-2 w-1/2 mt-4 bg-gray-600 text-white"
                >
                </button>
            </div>
        </div>
    </div>
</body>
</html>





