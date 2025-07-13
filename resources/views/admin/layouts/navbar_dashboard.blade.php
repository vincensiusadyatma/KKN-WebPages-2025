   <header class="flex items-center h-20 px-6 sm:px-10 bg-white">
  <!-- Menu Button for Mobile -->
  <button class="block sm:hidden relative flex-shrink-0 p-2 mr-2 text-gray-600 hover:bg-gray-100 hover:text-gray-800 focus:bg-gray-100 focus:text-gray-800 rounded-full">
    <span class="sr-only">Menu</span>
    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" class="h-6 w-6">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7" />
    </svg>
  </button>

  <!-- Search Input -->
  <div class="relative w-full max-w-md sm:-ml-2">
    <svg viewBox="0 0 20 20" fill="currentColor" class="absolute h-6 w-6 mt-2.5 ml-2 text-gray-400">
      <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
    </svg>
    <input type="text" placeholder="Search..." class="py-2 pl-10 pr-4 w-full border-4 border-transparent placeholder-gray-400 focus:bg-gray-50 rounded-lg" />
  </div>

  <!-- Right Side: User Info & Buttons -->
  <div class="flex items-center ml-auto space-x-4">
    <!-- Notification -->
    <button class="relative p-2 text-gray-400 hover:bg-gray-100 hover:text-gray-600 focus:bg-gray-100 focus:text-gray-600 rounded-full">
      <span class="sr-only">Notifications</span>
      <span class="absolute top-0 right-0 h-2 w-2 mt-1 mr-2 bg-red-500 rounded-full"></span>
      <span class="absolute top-0 right-0 h-2 w-2 mt-1 mr-2 bg-red-500 rounded-full animate-ping"></span>
      <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" class="h-6 w-6">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1" />
      </svg>
    </button>

    <!-- User Profile -->
    <div class="flex items-center space-x-3">
      <div class="hidden md:flex flex-col items-end leading-tight">
        <span class="font-semibold">{{ $user->username }}</span>
        <span class="text-sm text-gray-600">{{ $user->roles->first()?->name }}</span>
      </div>
      <img src="{{ asset('img/profile1.png') }}" alt="User Photo" class="h-12 w-12 rounded-full object-cover border border-gray-300" />

    </div>

    <!-- Logout Button -->
    <a href="/logout" class="p-2 text-gray-400 hover:bg-gray-100 hover:text-gray-600 focus:bg-gray-100 focus:text-gray-600 rounded-full" title="Logout">
      <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" class="h-6 w-6">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
      </svg>
    </a>
  </div>
</header>
