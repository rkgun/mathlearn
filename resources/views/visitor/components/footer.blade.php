<footer class="footer">
			<div class="container mx-auto px-6">
				<div class="sm:flex sm:mt-8">
					<div class="mt-8 sm:mt-0 sm:w-full sm:px-8 flex flex-col md:flex-row justify-between">
						<div class="flex flex-col">
							<span class="footer-head">Yasal</span>
							<span class="my-2">Telif Hakkı © <a href="{{ url('/') }}" class="footer-link"> {{$setting['site_name']}}</a></span>
							<span class="my-2">{{$setting['author']}}</span>
							<span class="my-2"><a href="{{ url('privacy&policy') }}" class="footer-link">Gizlilik Politikası</a></span>
						</div>
						<div class="flex flex-col">
							<span class="footer-head">İletişim</span>
							<span class="my-2"><a href="{{ url('contact') }}" class="footer-link">İletişim Sayfamız</a></span>
							<span class="my-2"><a href="mailto:{{$setting['mail']}}" class="footer-link">Mail Adresimiz</a></span>
						</div>
						<div class="flex flex-col">
							<span class="footer-head">Araçlar</span>
							<img class="w-full h-32" title="Bu web sitesi Katex tarafından desteklenmektedir." src="https://katex.org/img/og_logo.png"/>
						</div>
					</div>
				</div>
			</div>
			<div class="container mx-auto px-6">
				<div class="mt-16 border-t-2 border-gray-300 flex flex-col items-center">
					<div class="sm:w-2/3 text-center py-6">
						<p class="text-sm text-gray-600 font-bold mb-2">
							© 2021 Redday
						</p>
					</div>
				</div>
			</div>
		</footer>
		<script defer src="https://cdn.jsdelivr.net/npm/katex@0.15.1/dist/katex.min.js"></script>
		<script defer src="https://cdn.jsdelivr.net/npm/katex@0.15.1/dist/contrib/auto-render.min.js"  onload="renderMathInElement(document.body);"></script>
	</body>
</html>