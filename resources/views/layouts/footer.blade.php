<footer class="footer footer-black  footer-white ">
    <div class="container-fluid">
        <div class="row">
            <nav class="footer-nav">
                <ul>
                    <li>
                        <a href="#" target="_blank">{{ __('UBCS Project') }}</a>
                    </li>
                    <li>
                        <a href="https://www.ub.bw" target="_blank">{{ __('UB') }}</a>
                    </li>
                    <li>
                        <a href="#" target="_blank">{{ __('CS Department') }}</a>
                    </li>
                    <li>
                        <a href="#" target="_blank">{{ __('Licenses') }}</a>
                    </li>
                </ul>
            </nav>
            <div class="credits ml-auto">
                <span class="copyright">
                    ©
                    <script>
                        document.write(new Date().getFullYear())
                    </script>{{ __(', made with ') }}<i class="fa fa-heart heart"></i>{{ __(' by ') }}<a class="@if(Auth::guest()) text-white @endif" href="#" target="_blank">{{ __('Thabang Ntshane') }}</a>
                </span>
            </div>
        </div>
    </div>
</footer>