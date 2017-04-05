import java.util.*;

public class RevolvingDoors {
  int height;
  int width;
  int numberDoors;
  char[][] map;
  boolean[][][] visited;
  PQ q;
  static class Entry {
    public int key;
    public int x, y, d;
    public Entry(int key, int a, int b, int c) {
      this.key = key;
      x = a;
      y = b;
      d = c;
    }
  }
  static class PQ {
    ArrayList q = new ArrayList();

    public boolean isEmpty() {
      return q.isEmpty();
    }

    int parent(int i) {
      return (i+1)/2-1;
    }
    int left(int i) {
      return (i+1)*2-1;
    }
    int right(int i) {
      return (i+1)*2;
    }
    public void add(int key, int x, int y, int stateDoors) {
      q.add(null);
      int i = q.size() - 1;
      while (i > 0 && ((Entry) q.get(parent(i))).key > key) {
        q.set(i, q.get(parent(i)));
        i = parent(i);
      }
      q.set(i, new Entry(key, x, y, stateDoors));
    }
    public Entry popEntry() {
      Entry e = (Entry) q.get(0);
      q.set(0, q.get(q.size() - 1));
      q.remove(q.size() - 1);

      int i = 0;
      boolean done = false;
      while (!done) {
        int l = left(i), r = right(i);
        int min = i;
        if (l < q.size() && ((Entry) q.get(l)).key < ((Entry) q.get(min)).key) {
          min = l;
        }
        if (r < q.size() && ((Entry) q.get(r)).key < ((Entry) q.get(min)).key) {
          min = r;
        }
        if (min != i) {
          Object temp = q.get(min);
          q.set(min, q.get(i));
          q.set(i, temp);
          i = min;
        } else {
          done = true;
        }
      }
      return e;
    }
  }
  void add(Entry e, int dx, int dy) {
    int x = e.x + dx;
    int y = e.y + dy;
    if (x < 0 || y < 0 || x >= width || y >= height || map[y][x] == '#') return;
    int key = e.key;
    int s = e.d;
    if (map[y][x] >= 150) {
      int d = map[y][x] - 150;
      if ((s & 1 << d) == 0) {
        if (dy == 0) return;
        key++;
        s ^= 1 << d;
      }
    } else if (map[y][x] >= 130) {
      int d = map[y][x] - 130;
      if ((s & 1 << d) != 0) {
        if (dx == 0) return;
        key++;
        s ^= 1 << d;
      }
    }
    q.add(key, x, y, s);
  }
  void add2(Entry e, int dx, int dy) {
    int x = e.x + dx;
    int y = e.y + dy;
    if (x < 0 || y < 0 || x >= width || y >= height || map[y][x] == '#') return;
    q.add(e.key, x, y, 0);
  }
  boolean safe(int startX, int startY, int endX, int endY) {
    q = new PQ();
    q.add(0, startX, startY, 0);
    boolean[][] visited = new boolean[height][width];
    while (!q.isEmpty()) {
      Entry e = (Entry) q.popEntry();
      if (visited[e.y][e.x]) continue;
      visited[e.y][e.x] = true;
      if (endY == e.y && e.x == endX) return true;
      add2(e, 1, 0);
      add2(e, 0, 1);
      add2(e, -1, 0);
      add2(e, 0, -1);
    }
    return false;
  }
  public int turns(String[] mmap) {

    height = mmap.length;
    width = mmap[0].length();
    map = new char[height][];

    int startX = -1, startY = -1, stateDoors = 0, endX = -1, endY = -1;
    numberDoors = 0;
    for (int i = 0; i < height; i++)
      map[i] = mmap[i].toCharArray();
    for (int i = 0; i < height; i++)
      for (int j = 0; j < width; j++)
        if (map[i][j] == 'S') {
          startX = j;
          startY = i;
        } else if (map[i][j] == 'E') {
          endX = j;
          endY = i;
        }
    for (int i = 0; i < height; i++)
      for (int j = 0; j < width; j++)
        if (map[i][j] == 'O') {
          if (map[i - 1][j] == '|') stateDoors |= 1 << numberDoors;
          map[i - 1][j] = (char) (130 + numberDoors);
          map[i + 1][j] = (char) (130 + numberDoors);
          map[i][j - 1] = (char) (150 + numberDoors);
          map[i][j + 1] = (char) (150 + numberDoors);
          map[i][j] = '#';
          numberDoors++;
        }

    /**
     * all doors as states. All map as state.
    **/
    visited = new boolean[height][width][1 << numberDoors];
    if (!safe(startX, startY, endX, endY)) return -1;
    q = new PQ();
    q.add(0, startX, startY, stateDoors);
    while (!q.isEmpty()) {
      Entry e = (Entry) q.popEntry();
      if (visited[e.y][e.x][e.d]) continue;
      visited[e.y][e.x][e.d] = true;
      if (endY == e.y && e.x == endX) return e.key;
      add(e, 1, 0);
      add(e, 0, 1);
      add(e, -1, 0);
      add(e, 0, -1);
    }
    return -1;
  }
}
