<!-- Sidebar -->
<div id="application-sidebar"
    class="hs-overlay hs-overlay-open:translate-x-0 -translate-x-full transition-all duration-300 transform hidden fixed top-0 left-0 bottom-0 z-[60] w-64 bg-white border-r border-gray-200 pt-7 pb-10 overflow-y-auto scrollbar-y lg:block lg:translate-x-0 lg:right-auto lg:bottom-0 dark:scrollbar-y dark:bg-gray-800 dark:border-gray-700">
    <div class="px-6">
        <a class="flex-none text-xl font-semibold dark:text-white" href="{{ route('admin.index') }}"
            aria-label="{{ config('app.name', 'Octosync Software Ltd') }}">
            {{ config('app.name', 'Octosync Software Ltd') }}
        </a>
    </div>

    <nav class="hs-accordion-group p-6 w-full flex flex-col flex-wrap" data-hs-accordion-always-open>
        <ul class="space-y-1.5">
            <li>
                <a class="flex items-center gap-x-3.5 py-2 px-2.5 text-sm text-slate-700 rounded-md hover:bg-gray-100 dark:bg-gray-900 dark:text-white
                {{ in_array(Route::currentRouteName(), ['admin.index', '']) ? 'bg-gray-200 dark:bg-gray-900' : 'text-slate-700' }}"
                    href="{{ route('admin.index') }}">
                    <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path
                            d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z" />
                    </svg>
                    Dashboard
                </a>
            </li>
            @can('accounts')
                <li>
                    <a class="flex items-center gap-x-3.5 py-2 px-2.5 text-sm text-slate-700 rounded-md hover:bg-gray-100 dark:bg-gray-900 dark:text-white
                {{ in_array(Route::currentRouteName(), [
                    'admin.accounts.index',
                    'admin.accounts.create',
                    'admin.accounts.edit',
                    'admin.accounts.show',
                    'admin.income-categories.index',
                    'admin.income-categories.create',
                    'admin.income-categories.edit',
                    'admin.income-categories.show',
                    'admin.expense-categories.index',
                    'admin.expense-categories.create',
                    'admin.expense-categories.edit',
                    'admin.expense-categories.show',
                    'admin.incomes.index',
                    'admin.expenses.index',
                    'admin.incomes.create',
                    'admin.expenses.create',
                    'admin.incomes.edit',
                    'admin.expenses.edit',
                ])
                    ? 'bg-gray-200 dark:bg-gray-900'
                    : 'text-slate-700' }}"
                        href="{{ route('admin.accounts.index') }}">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5">
                            <path fill-rule="evenodd"
                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm.75-11a.75.75 0 00-1.5 0v.25c-.8.07-1.52.34-2.03.78a2.06 2.06 0 00-.72 1.62c0 .92.64 1.61 1.42 1.99.66.33 1.52.53 2.33.66.7.12 1.31.24 1.7.44.39.19.55.39.55.69 0 .31-.18.53-.45.7-.31.2-.77.31-1.29.31-.52 0-.99-.1-1.32-.29a.75.75 0 10-.76 1.3c.54.31 1.23.47 1.96.5v.25a.75.75 0 001.5 0v-.26c.77-.1 1.46-.38 1.95-.8.53-.45.85-1.06.85-1.75 0-.91-.63-1.57-1.38-1.94-.67-.33-1.54-.52-2.36-.65-.67-.11-1.28-.23-1.66-.43-.38-.19-.54-.39-.54-.68 0-.3.16-.51.4-.67.28-.19.69-.29 1.17-.29.48 0 .92.1 1.2.28a.75.75 0 10.78-1.29 3.68 3.68 0 00-1.48-.43V7z"
                                clip-rule="evenodd" />
                        </svg>
                        Accounts Section
                    </a>
                </li>
            @endcan
            @can('announcement')
                <li>
                    <a class="flex items-center gap-x-3.5 py-2 px-2.5 text-sm text-slate-700 rounded-md hover:bg-gray-100 dark:bg-gray-900 dark:text-white
                {{ in_array(Route::currentRouteName(), ['admin.announcements.index', 'admin.announcements.create', 'admin.announcements.edit', 'admin.announcements.show']) ? 'bg-gray-200 dark:bg-gray-900' : 'text-slate-700' }}"
                        href="{{ route('admin.announcements.index') }}">
                        <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z"
                                clip-rule="evenodd" />
                        </svg>
                        Announcements
                    </a>
                </li>
            @endcan
            @can('member')
                <li>
                    <a class="flex items-center gap-x-3.5 py-2 px-2.5 text-sm text-slate-700 rounded-md hover:bg-gray-100 dark:bg-gray-900 dark:text-white
                {{ in_array(Route::currentRouteName(), ['admin.members.index', 'admin.members.create', 'admin.members.edit', 'admin.members.show', 'admin.executive-committees.index', 'admin.executive-committees.create', 'admin.executive-committees.edit', 'admin.members.executive']) ? 'bg-gray-200 dark:bg-gray-900' : 'text-slate-700' }}"
                        href="{{ route('admin.members.index') }}">
                        <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path
                                d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z" />
                        </svg>
                        Members
                    </a>
                </li>
            @endcan
            @can('event')
                <li>
                    <a class="flex items-center gap-x-3.5 py-2 px-2.5 text-sm text-slate-700 rounded-md hover:bg-gray-100 dark:bg-gray-900 dark:text-white
                {{ in_array(Route::currentRouteName(), ['admin.events.index', 'admin.events.create', 'admin.events.edit', 'admin.events.show', 'admin.events.participants']) ? 'bg-gray-200 dark:bg-gray-900' : 'text-slate-700' }}"
                        href="{{ route('admin.events.index') }}">
                        <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z"
                                clip-rule="evenodd" />
                        </svg>
                        Events
                    </a>
                </li>
            @endcan
            @can('project')
                <li>
                    <a class="flex items-center gap-x-3.5 py-2 px-2.5 text-sm text-slate-700 rounded-md hover:bg-gray-100 dark:bg-gray-900 dark:text-white
                {{ in_array(Route::currentRouteName(), ['admin.projects.index', 'admin.projects.create', 'admin.projects.edit']) ? 'bg-gray-200 dark:bg-gray-900' : 'text-slate-700' }}"
                        href="{{ route('admin.projects.index') }}">
                        <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M3 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z"
                                clip-rule="evenodd" />
                        </svg>
                        Projects
                    </a>
                </li>
            @endcan
            @can('blog')
                <li>
                    <a class="flex items-center gap-x-3.5 py-2 px-2.5 text-sm text-slate-700 rounded-md hover:bg-gray-100 dark:bg-gray-900 dark:text-white
                {{ in_array(Route::currentRouteName(), ['admin.blog.posts.index', 'admin.blog.posts.create', 'admin.blog.posts.edit']) ? 'bg-gray-200 dark:bg-gray-900' : 'text-slate-700' }}"
                        href="{{ route('admin.blog.posts.index') }}">
                        <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M2 5a2 2 0 012-2h8a2 2 0 012 2v10a2 2 0 002 2H4a2 2 0 01-2-2V5zm3 1h6v4H5V6zm6 6H5v2h6v-2z"
                                clip-rule="evenodd" />
                            <path d="M15 7h1a2 2 0 012 2v5.5a1.5 1.5 0 01-3 0V7z" />
                        </svg>
                        Blogs
                    </a>
                </li>
            @endcan
            @can('gallery')
                <li>
                    <a class="flex items-center gap-x-3.5 py-2 px-2.5 text-sm text-slate-700 rounded-md hover:bg-gray-100 dark:bg-gray-900 dark:text-white
                {{ in_array(Route::currentRouteName(), ['admin.galleries.index', 'admin.galleries.create', 'admin.galleries.edit']) ? 'bg-gray-200 dark:bg-gray-900' : 'text-slate-700' }}"
                        href="{{ route('admin.galleries.index') }}">
                        <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z"
                                clip-rule="evenodd" />
                        </svg>
                        Galleries
                    </a>
                </li>
            @endcan
            @can('contact')
                <li>
                    <a class="flex items-center gap-x-3.5 py-2 px-2.5 text-sm text-slate-700 rounded-md hover:bg-gray-100 dark:bg-gray-900 dark:text-white
                {{ in_array(Route::currentRouteName(), ['admin.contacts.index', 'admin.contacts.create', 'admin.contacts.edit', 'admin.contacts.show']) ? 'bg-gray-200 dark:bg-gray-900' : 'text-slate-700' }}"
                        href="{{ route('admin.contacts.index') }}">
                        <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M18 5v8a2 2 0 01-2 2h-5v3.586l4.293-4.293a1 1 0 011.414 1.414l-6 6a1 1 0 01-1.414 0l-6-6a1 1 0 011.414-1.414L11 18.586V15H4a2 2 0 01-2-2V5a2 2 0 012-2h12a2 2 0 012 2zm-4-1H4a1 1 0 00-1 1v1h14V5a1 1 0 00-1-1z"
                                clip-rule="evenodd" />
                        </svg>
                        Contacts
                    </a>
                </li>
            @endcan
            @role('super_admin')
                <li class="hs-accordion {{ in_array(Route::currentRouteName(), ['admin.role', 'admin.role.createPage', 'admin.role.edit', 'admin.permission', 'admin.permission.createPage', 'admin.permission.edit', 'admin.users.index', 'admin.users.create', 'admin.users.show']) ? 'hs-accordion-active' : '' }}"
                    id="account-accordion">
                    <a class="hs-accordion-toggle flex items-center gap-x-3.5 py-2 px-2.5 hs-accordion-active:text-blue-600 hs-accordion-active:hover:bg-transparent text-sm text-slate-700 rounded-md hover:bg-gray-100 dark:bg-gray-800 dark:hover:bg-gray-900 dark:text-slate-400 dark:hover:text-slate-300 dark:hs-accordion-active:text-white"
                        href="javascript:;">
                        <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"
                                clip-rule="evenodd" />
                        </svg>
                        Account

                        <svg class="hs-accordion-active:block ml-auto hidden w-3 h-3 text-gray-600 group-hover:text-gray-500 dark:text-gray-400"
                            width="16" height="16" viewBox="0 0 16 16" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path d="M2 11L8.16086 5.31305C8.35239 5.13625 8.64761 5.13625 8.83914 5.31305L15 11"
                                stroke="currentColor" stroke-width="2" stroke-linecap="round"></path>
                        </svg>

                        <svg class="hs-accordion-active:hidden ml-auto block w-3 h-3 text-gray-600 group-hover:text-gray-500 dark:text-gray-400"
                            width="16" height="16" viewBox="0 0 16 16" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path d="M2 5L8.16086 10.6869C8.35239 10.8637 8.64761 10.8637 8.83914 10.6869L15 5"
                                stroke="currentColor" stroke-width="2" stroke-linecap="round"></path>
                        </svg>
                    </a>

                    <div id="account-accordion-sub"
                        class="hs-accordion-content w-full overflow-hidden transition-[height] duration-300 {{ in_array(Route::currentRouteName(), ['admin.role', 'admin.role.createPage', 'admin.role.edit', 'admin.permission', 'admin.permission.createPage', 'admin.permission.edit', 'admin.users.index', 'admin.users.create', 'admin.users.show']) ? 'block' : 'hidden' }}">
                        <ul class="pt-2 pl-2">
                            @can('role')
                                <li>
                                    <a class="flex items-center gap-x-3.5 py-2 px-2.5 text-sm text-slate-700 rounded-md hover:bg-gray-100 dark:bg-gray-800 dark:text-white 
                                    {{ in_array(Route::currentRouteName(), ['admin.role', 'admin.role.createPage', 'admin.role.edit']) ? 'bg-gray-200 dark:bg-gray-900' : 'text-slate-700' }}"
                                        href="{{ route('admin.role') }}">
                                        <svg class="w-3.5 h-3.5 mr-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                            fill="currentColor">
                                            <path fill-rule="evenodd"
                                                d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                                clip-rule="evenodd" />
                                        </svg>
                                        Roles
                                    </a>
                                </li>
                            @endcan
                            @can('permission')
                                <li>
                                    <a class="flex items-center gap-x-3.5 py-2 px-2.5 text-sm text-slate-700 rounded-md hover:bg-gray-100 dark:bg-gray-800 dark:text-white 
                                    {{ in_array(Route::currentRouteName(), ['admin.permission', 'admin.permission.createPage', 'admin.permission.edit']) ? 'bg-gray-200 dark:bg-gray-900' : 'text-slate-700' }}"
                                        href="{{ route('admin.permission') }}">
                                        <svg class="w-3.5 h-3.5 mr-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                            fill="currentColor">
                                            <path fill-rule="evenodd"
                                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                                clip-rule="evenodd" />
                                        </svg>
                                        Permissions
                                    </a>
                                </li>
                            @endcan
                            @can('user')
                                <li>
                                    <a class="flex items-center gap-x-3.5 py-2 px-2.5 text-sm text-slate-700 rounded-md hover:bg-gray-100 dark:bg-gray-800 dark:text-white 
                                    {{ in_array(Route::currentRouteName(), ['admin.users.index', 'admin.users.create', 'admin.users.show']) ? 'bg-gray-200 dark:bg-gray-900' : 'text-slate-700' }}"
                                        href="{{ route('admin.users.index') }}">
                                        <svg class="w-3.5 h-3.5 mr-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                            fill="currentColor">
                                            <path
                                                d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z" />
                                        </svg>
                                        Users
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </div>
                </li>
            @endrole
        </ul>
    </nav>
</div>
<!-- End Sidebar -->
