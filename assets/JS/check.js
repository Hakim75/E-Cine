const tl = new TimelineMax({
  repeat: 0,
  repeatDelay: 1.5,
  delay: 0.5,
  yoyo: true
});
const circle = $("#icon-oval");
const check = $("#icon-check");

tl.set(circle, { visibility: "visible" }).set(check, { visibility: "visible" });

tl.fromTo(
  circle,
  0.5,
  { drawSVG: "0" },
  { drawSVG: "0 100%", transformOrigin: "50% 0", ease: Power1.easeInOut }
).fromTo(
  check,
  0.25,
  { drawSVG: "0" },
  { drawSVG: "0 100%", ease: Power1.easeInOut }
);
