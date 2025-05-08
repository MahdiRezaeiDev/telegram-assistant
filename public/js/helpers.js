function toggleSidebar() {
  const sidebar = document.getElementById("side_bar");
  sidebar.classList.toggle("open");
}

const target = 9;
const mid = Math.ceil(target / 2);

for (start = 1; start <= target; start++) {
  const width = start > mid ? mid - (start - mid) : start;
  for (inner = 1; inner <= width; inner++) {
    console.log("*");
  }
  // console.log("\n");
}
