from PIL import Image, ImageEnhance
import colorsys
import os

img = Image.open('public/hero.png').convert('RGB')
w, h = img.size
pixels = list(img.getdata())

purple_count = 0
total_warm_shift = 0
fixed_pixels = []

for r, g, b in pixels:
    r_n, g_n, b_n = r/255.0, g/255.0, b/255.0
    h_hsl, l_hsl, s_hsl = colorsys.rgb_to_hls(r_n, g_n, b_n)
    was_corrected = False

    # Aggressive: anything in blue-to-purple range (0.55 to 0.95)
    if s_hsl > 0.03:
        if 0.55 <= h_hsl <= 0.95:
            was_corrected = True
        # Cool grays with any saturation
        elif s_hsl < 0.20 and l_hsl > 0.4 and b > r:
            was_corrected = True

    if was_corrected:
        purple_count += 1
        # Shift hue to warm orange
        new_h = 0.06
        # Increase saturation slightly for richer warm tones
        new_s = min(s_hsl * 1.2, 0.6)
        new_r, new_g, new_b = colorsys.hls_to_rgb(new_h, l_hsl, new_s)
        # Full blend
        blend = 0.75
        fr = int(r * (1-blend) + new_r * 255 * blend)
        fg = int(g * (1-blend) + new_g * 255 * blend)
        fb = int(b * (1-blend) + new_b * 255 * blend)
        fixed_pixels.append((min(fr,255), min(fg,255), min(fb,255)))
        total_warm_shift += 1
    else:
        fixed_pixels.append((r, g, b))

fixed_img = Image.new('RGB', (w, h))
fixed_img.putdata(fixed_pixels)

# Additional overall warm tone enhancement
enhancer = ImageEnhance.Color(fixed_img)
fixed_img = enhancer.enhance(0.85)  # Reduce overall color intensity slightly

fixed_img.save('public/hero.png', quality=95)
fixed_img.save('public/hero.webp', 'webp', quality=85, method=6)

png_size = os.path.getsize('public/hero.png') / 1024
webp_size = os.path.getsize('public/hero.webp') / 1024

print(f'Cool/purple-ish pixels shifted to warm: {purple_count} / {len(pixels)} ({purple_count/len(pixels)*100:.1f}%)')
print(f'hero.png size:  {png_size:.0f}KB')
print(f'hero.webp size: {webp_size:.0f}KB')

pixels2 = list(fixed_img.getdata())
purple_after = sum(1 for r,g,b in pixels2
    if 0.55 <= colorsys.rgb_to_hls(r/255,g/255,b/255)[0] <= 0.95
    and colorsys.rgb_to_hls(r/255,g/255,b/255)[2] > 0.03)
print(f'Cool/purple AFTER correction: {purple_after} / {len(pixels2)} ({purple_after/len(pixels2)*100:.1f}%)')
