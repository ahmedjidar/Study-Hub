<?php
session_start();

if(!isset($_SESSION['username'])){
    header("Location: login.php"); 
    exit;
}

?>

<p class="text-sm text-gray-400 mt-6 mb-2">Hello, <span class="underline"><?php echo $_SESSION['username'] ?></span></p>
<div class="relative w-full overflow-auto shadow-md rounded-2xl">
  <table class="w-full caption-bottom text-sm shadow-xl rounded-2xl">
    <thead class="[&amp;_tr]:border-b">
      <tr class="border-b transition-colors hover:bg-muted/50 data-[state=selected]:bg-muted">
        <th class="h-12 px-4 text-left align-middle font-medium text-muted-foreground [&amp;:has([role=checkbox])]:pr-0 w-[140px]">
          Student
        </th>
        <th class="h-12 px-4 text-left align-middle font-medium text-muted-foreground [&amp;:has([role=checkbox])]:pr-0 w-[120px]">
          ID
        </th>
        <th class="h-12 px-4 text-left align-middle font-medium text-muted-foreground [&amp;:has([role=checkbox])]:pr-0">
          Status
        </th>
        <th class="h-12 px-4 align-middle font-medium text-muted-foreground [&amp;:has([role=checkbox])]:pr-0 text-right">
          Last Update
        </th>
      </tr>
    </thead>
    <tbody class="[&amp;_tr:last-child]:border-0">
      <tr class="border-b transition-colors hover:bg-muted/50 data-[state=selected]:bg-muted">
        <td class="p-4 align-middle [&amp;:has([role=checkbox])]:pr-0 flex items-center gap-2">
          <div class="flex flex-col">
            <span class="font-medium">Emma Jones</span>
            <span class="text-sm font-normal leading-none text-neutral-500 dark:text-neutral-400 mt-2">
              emmajones@example.com
            </span>
          </div>
        </td>
        <td class="p-4 align-middle [&amp;:has([role=checkbox])]:pr-0 font-medium">ID001</td>
        <td class="p-4 align-middle [&amp;:has([role=checkbox])]:pr-0">
          <div class="inline-flex items-center rounded-full whitespace-nowrap border px-2.5 py-0.5 w-fit text-xs font-semibold transition-colors focus:outline-none focus:ring-2 focus:ring-ring focus:ring-offset-2">
            Under Observation
          </div>
        </td>
        <td class="p-4 align-middle [&amp;:has([role=checkbox])]:pr-0 text-right">2 days ago</td>
      </tr>
      <tr class="border-b transition-colors hover:bg-muted/50 data-[state=selected]:bg-muted">
        <td class="p-4 align-middle [&amp;:has([role=checkbox])]:pr-0 flex items-center gap-2">
          <div class="flex flex-col">
            <span class="font-medium">Noah Smith</span>
            <span class="text-sm font-normal leading-none text-neutral-500 dark:text-neutral-400 mt-2">
              noahsmith@example.com
            </span>
          </div>
        </td>
        <td class="p-4 align-middle [&amp;:has([role=checkbox])]:pr-0 font-medium">ID002</td>
        <td class="p-4 align-middle [&amp;:has([role=checkbox])]:pr-0">
          <div class="inline-flex items-center rounded-full whitespace-nowrap border px-2.5 py-0.5 w-fit text-xs font-semibold transition-colors focus:outline-none focus:ring-2 focus:ring-ring focus:ring-offset-2">
            Symptomatic
          </div>
        </td>
        <td class="p-4 align-middle [&amp;:has([role=checkbox])]:pr-0 text-right">1 day ago</td>
      </tr>
      <tr class="border-b transition-colors hover:bg-muted/50 data-[state=selected]:bg-muted">
        <td class="p-4 align-middle [&amp;:has([role=checkbox])]:pr-0 flex items-center gap-2">
          <div class="flex flex-col">
            <span class="font-medium">Olivia Johnson</span>
            <span class="text-sm font-normal leading-none text-neutral-500 dark:text-neutral-400 mt-2">
              oliviajohnson@example.com
            </span>
          </div>
        </td>
        <td class="p-4 align-middle [&amp;:has([role=checkbox])]:pr-0 font-medium">ID003</td>
        <td class="p-4 align-middle [&amp;:has([role=checkbox])]:pr-0">
          <div class="inline-flex items-center rounded-full whitespace-nowrap border px-2.5 py-0.5 w-fit text-xs font-semibold transition-colors focus:outline-none focus:ring-2 focus:ring-ring focus:ring-offset-2">
            Healthy
          </div>
        </td>
        <td class="p-4 align-middle [&amp;:has([role=checkbox])]:pr-0 text-right">4 days ago</td>
      </tr>
      <tr class="border-b transition-colors hover:bg-muted/50 data-[state=selected]:bg-muted">
        <td class="p-4 align-middle [&amp;:has([role=checkbox])]:pr-0 flex items-center gap-2">
          <div class="flex flex-col">
            <span class="font-medium">Liam Williams</span>
            <span class="text-sm font-normal leading-none text-neutral-500 dark:text-neutral-400 mt-2">
              liamwilliams@example.com
            </span>
          </div>
        </td>
        <td class="p-4 align-middle [&amp;:has([role=checkbox])]:pr-0 font-medium">ID004</td>
        <td class="p-4 align-middle [&amp;:has([role=checkbox])]:pr-0">
          <div class="inline-flex items-center rounded-full whitespace-nowrap border px-2.5 py-0.5 w-fit text-xs font-semibold transition-colors focus:outline-none focus:ring-2 focus:ring-ring focus:ring-offset-2">
            Positive
          </div>
        </td>
        <td class="p-4 align-middle [&amp;:has([role=checkbox])]:pr-0 text-right">Just now</td>
      </tr>
    </tbody>
  </table>
</div>