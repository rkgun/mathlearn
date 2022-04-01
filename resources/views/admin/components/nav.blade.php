<nav aria-label="alternative nav">
            <div class="bg-gray-800 shadow-xl h-20 fixed bottom-0 mt-12 md:relative md:h-screen z-10 w-full md:w-48 content-center">

                <div class="md:mt-12 md:w-48 md:fixed md:left-0 md:top-0 content-center md:content-start text-left justify-between">
                    <ul class="list-reset flex flex-row md:flex-col pt-3 md:py-3 px-1 md:px-2 text-center md:text-left">
                        <li class="mr-3 flex-1">
                            <a href="{{ route('dashboard') }}" class="block py-1 md:py-3 pl-1 align-middle text-white no-underline hover:text-white 
                            {{ (request()->is('admin/dashboard')) ? 'border-b-2 ' : '' }}border-blue-600">
                                <i class="fas fa-chart-area pr-0 md:pr-3 {{(request()->is('admin/dashboard')) ? 'text-blue-600' : '' }}"></i>
                                <span class="pb-1 md:pb-0 text-xs md:text-base text-white md:text-white block md:inline-block">İstatistikler</span>
                            </a>
                        </li>
                        <li class="mr-3 flex-1">
                            <a href="{{ route('course.list') }}" class="block py-1 md:py-3 pl-1 align-middle text-white no-underline hover:text-white {{(request()->is('admin/courses')) ? 'border-b-2' : '' }} border-white-800">
                                <i class="fas fa-tasks pr-0 md:pr-3"></i><span class="pb-1 md:pb-0 text-xs md:text-base text-gray-400 md:text-gray-200 block md:inline-block">Dersler</span>
                            </a>
                        </li>
                        <li class="mr-3 flex-1">
                            <a href="{{ route('topic.list') }}" class="block py-1 md:py-3 pl-1 align-middle text-white no-underline hover:text-white {{(request()->is('admin/topics')) ? 'border-b-2' : '' }} border-white-800">
                                <i class="fa-solid fa-hashtag pr-0 md:pr-3"></i><span class="pb-1 md:pb-0 text-xs md:text-base text-gray-400 md:text-gray-200 block md:inline-block">Konular</span>
                            </a>
                        </li>
                        <li class="mr-3 flex-1">
                            <a href="{{ route('page.list') }}" class="block py-1 md:py-3 pl-1 align-middle text-white no-underline hover:text-white {{(request()->is('admin/pages')) ? 'border-b-2' : '' }} border-white-800">
                                <i class="fa-solid fa-file pr-0 md:pr-3"></i><span class="pb-1 md:pb-0 text-xs md:text-base text-gray-400 md:text-gray-200 block md:inline-block">Sayfalar</span>
                            </a>
                        </li>
                        <li class="mr-3 flex-1">
                            <a href="{{route('contact.list')}}" class="block py-1 md:py-3 pl-1 align-middle text-white no-underline hover:text-white 
                            {{(request()->is('admin/contacts')) ? 'border-b-2' : '' }}  border-green-800">
                                <i class="fa fa-envelope pr-0 md:pr-3 {{(request()->is('admin/contacts')) ? 'text-green-400' : '' }} "></i><span class="pb-1 md:pb-0 text-xs md:text-base text-gray-400 md:text-gray-200 block md:inline-block">İletişimler</span>
                            </a>
                        </li>
                    </ul>
                </div>


            </div>
        </nav>