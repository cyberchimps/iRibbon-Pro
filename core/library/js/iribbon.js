/**
 * Helps iRibbon create extended titles in a responsive way
 */
jQuery(document).ready(function($) {
	
function str_split(str, chunk_size)
{
  var a_chunks = [], index = 0;
  do 
  {
    a_chunks.push(str.slice(index, index+chunk_size));
    index += chunk_size;  
  }
  while (index < str.length)
  return a_chunks;
}

function ribbon_size()
{
	$( '.posts_title' ).each(function(index) {
		 var title = $(this).text();
		 var url = $(this).children('a').attr('href');
		 var length = title.length;
		 var width = parseFloat($(this).css('width'));
		 var font_width = 15;
		 var chunks = parseInt(length*font_width/width);
		 var chunk_size = parseInt(length/chunks);
		 var chunk_array = '';
		 
		 if(chunks > 1)
		 {
			chunk_array = ( str_split(title, chunk_size) );
			if(url)
			{
				$(this).children('a').text(chunk_array[0] + '-'); 
			}
			else {
				$(this).text(chunk_array[0] + '-');
			}
		 	var i = 1;
				while(i <= chunks)
				{
					if(i == chunks)
					{
						$(this).parent('.ribbon-top').next('.ribbon-shadow').after(
					'<div class="ribbon-more" style="top:' + ((i)*65) + 'px"><h2 class="posts_title"><a href="' + url + '">' + chunk_array[i] + '</a></h2><div class="ribbon-extra"></div><!-- ribbon extra --></div><!-- ribbon top --><div class="ribbon-shadow" style="top:' + ((i)*65 + 44) + 'px"></div><!-- ribbon shadow --><div style="padding-top:' + ((i)*65) + 'px"></div>');
					}
					else{
					$(this).parent('.ribbon-top').next('.ribbon-shadow').after(
					'<div class="ribbon-more" style="top:' + ((i)*65) + 'px"><h2 class="posts_title"><a href="' + url + '">' + chunk_array[i] + '-</a></h2><div class="ribbon-extra"></div><!-- ribbon extra --></div><!-- ribbon top --><div class="ribbon-shadow" style="top:' + ((i)*65 + 44) + 'px"></div><!-- ribbon shadow -->');
					}
					i++;
				}
		 }
	 });
}
/* run the ribbon function */
ribbon_size();
/* this makes the ribbon width the right width for the post container */
var sls_rm = parseInt($('.sd_left_sidebar div.ribbon-more').css('width'));
$('.sd_left_sidebar div.ribbon-more').css('width', (sls_rm + 30) + 'px')
});