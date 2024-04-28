<?php
session_start();

if(!isset($_SESSION['username'])){
    header("Location: login.php"); 
    exit;
}

?>

<p class="text-sm text-gray-400 mt-6 mb-2">Here are your Announcements, <span class="underline"><?php echo $_SESSION['username'] ?></span></p>
<div class="w-full shadow-md rounded-2xl">
  <div class="flex flex-col gap-4 px-4 py-6 md:py-8 shadow-md rounded-2xl">
    <div class="shadow-md border border-gray-200 rounded-lg p-4 flex items-center gap-4 md:p-6 lg:gap-6 xl:grid xl:grid-cols-[auto_1fr]">
      <span class="flex-shrink-0 w-10 h-10 rounded-full border border-gray-200 overflow-hidden">
        <img
          src="https://placehold.co/600x400/gray/white?text=!"
          width="40"
          height="40"
          alt="Avatar"
          class="rounded-full object-cover object-center shadow-md"
          style="aspect-ratio: 40 / 40; object-fit: cover;"
        />
      </span>
      <div class="space-y-2.5 md:space-y-4 xl:col-start-2">
        <div class="text-sm font-medium tracking-wide uppercase text-gray-500 dark:text-gray-400">Announcement</div>
        <div class="text-base font-semibold leading-none sm:text-lg">Introducing the new design system</div>
        <p class="text-sm text-gray-500 dark:text-gray-400">
          We're excited to announce the launch of our new design system. It's now easier than ever to create
          beautiful and consistent user interfaces.
        </p>
      </div>
    </div>
    <div class="shadow-md border-t border-gray-200 rounded-lg p-4 flex items-center gap-4 md:p-6 lg:gap-6 xl:grid xl:grid-cols-[auto_1fr]">
      <span class="flex-shrink-0 w-10 h-10 rounded-full border border-gray-200 overflow-hidden">
        <img
          src="https://placehold.co/600x400/gray/white?text=!"
          width="40"
          height="40"
          alt="Avatar"
          class="rounded-full object-cover object-center shadow-md"
          style="aspect-ratio: 40 / 40; object-fit: cover;"
        />
      </span>
      <div class="space-y-2.5 md:space-y-4 xl:col-start-2">
        <div class="text-sm font-medium tracking-wide uppercase text-gray-500 dark:text-gray-400">Announcement</div>
        <div class="text-base font-semibold leading-none sm:text-lg">New Features: Spring Edition</div>
        <p class="text-sm text-gray-500 dark:text-gray-400">
            We’re thrilled to unveil our newly developed design framework. Creating visually appealing and uniform user interfaces has never been more straightforward.
        </p>
      </div>
    </div>
    <div class="shadow-md border-t border-gray-200 rounded-lg p-4 flex items-center gap-4 md:p-6 lg:gap-6 xl:grid xl:grid-cols-[auto_1fr]">
      <span class="flex-shrink-0 w-10 h-10 rounded-full border border-gray-200 overflow-hidden">
        <img
          src="https://placehold.co/600x400/gray/white?text=!"
          width="40"
          height="40"
          alt="Avatar"
          class="rounded-full object-cover object-center shadow-md"
          style="aspect-ratio: 40 / 40; object-fit: cover;"
        />
      </span>
      <div class="space-y-2.5 md:space-y-4 xl:col-start-2">
        <div class="text-sm font-medium tracking-wide uppercase text-gray-500 dark:text-gray-400">Announcement</div>
        <div class="text-base font-semibold leading-none sm:text-lg">Meet the Team: Employee Spotlight</div>
        <p class="text-sm text-gray-500 dark:text-gray-400">
            We’re delighted to introduce our innovative design system. It’s now simpler than ever to craft aesthetically pleasing and consistent user experiences.
        </p>
      </div>
    </div>
  </div>
</div>