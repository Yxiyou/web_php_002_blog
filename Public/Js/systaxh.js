$(document).ready(function () {
	var syn = $('pre');
	syn.each(function () {
		var name = $(this).attr('class');
		name = name.slice(6);
        name = name.replace(/\b\w+\b/g, function(word){ return word.substring(0,1).toUpperCase()+word.substring(1);} );
		var text = "<script type='text/javascript' src='/Public/SyntaxHighlighter/scripts/shBrush"+name+".js'></script>\n";
		syn.after(text);
	});
});
