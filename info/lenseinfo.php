<b>Lense.php &copy; 2006 Tom Beale</b>
<p>
This page uses two images to simulate either an X-Ray or Magnifying-glass effect. 
<hr>
For the curious, a PHP call is used to get the dimensions of both images, then the first image is displayed normally on the page. The second image is located over the first image, but only displays through a clipping region. when the mouse moves, JavaScript uses the mouse x,y to calculate the new location of the clipping region and the new location of the large image so that the pointer location is pointing to the same point on both images. 