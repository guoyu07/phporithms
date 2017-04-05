#include <string>
#include <algorithm>
#include <sstream>
#include <iostream>
#include <deque>
#include <vector>

using namespace std;

int dist[55][55][1<<10];
int otacam[55][55];
int ho[55][55];
int ve[55][55];
int dx[]={1,-1,0,0};
int dy[]={0,0,1,-1};
class RevolvingDoors {
public:
  int turns(vector <string> map) {
    for (int i=0;i<map.size();i++) {
      map[i]='#'+map[i]+'#';
    }
    memset(otacam,-1,sizeof(otacam));
    string s(map[0].size(),'#');
    map.push_back(s);
    map.insert(map.begin(),s);
    memset(dist,-1,sizeof(dist));
    memset(ho,-1,sizeof(ho));
    memset(ve,-1,sizeof(ve));
    vector<pair<int,int> > dvere;
    int si=0,sj=0,ei=0,ej=0;
    int poc=0;
    for (int i=0;i<map.size();i++) {
      for (int j=0;j<map[0].size();j++) {
        if (map[i][j]=='O') {
          if (map[i-1][j]=='|' || map[i+1][j]=='|') {
            poc|=1<<dvere.size();
          }
          otacam[i+1][j+1]=dvere.size();
          otacam[i+1][j-1]=dvere.size();
          otacam[i-1][j+1]=dvere.size();
          otacam[i-1][j-1]=dvere.size();

          ve[i-1][j]=dvere.size();
          ve[i+1][j]=dvere.size();

          ho[i][j-1]=dvere.size();
          ho[i][j+1]=dvere.size();

          dvere.push_back(make_pair(i,j));
        }
        if (map[i][j]=='S') {
          si=i; sj=j;
          map[i][j]=' ';
        }
        if (map[i][j]=='E') {
          ei=i; ej=j;
          map[i][j]=' ';
        }
      }
    }
    for (int i=0;i<map.size();i++) {
      for (int j=0;j<map[0].size();j++) {
        if (map[i][j]=='-' || map[i][j]=='|')
          map[i][j]=' ';
      }
    }
    dist[si][sj][poc]=0;
    deque<pair<pair<char,char>,int> > q;
    q.push_back(make_pair(make_pair(si,sj),poc));
    while (!q.empty()) {
      int ai=q.front().first.first;
      int aj=q.front().first.second;
      int as=q.front().second;
      if (ai==ei && aj==ej) return dist[ai][aj][as];
      q.pop_front();
      for (int d=0;d<4;d++) {
        int ni=ai+dx[d];
        int nj=aj+dy[d];
        if (ho[ni][nj]!=-1 && ((1<<ho[ni][nj])&as)==0) continue;
        if (ve[ni][nj]!=-1 && ((1<<ve[ni][nj])&as)) continue;
        if (map[ni][nj]==' ' && (dist[ni][nj][as]==-1 || dist[ni][nj][as]>dist[ai][aj][as])) {
          q.push_front(make_pair(make_pair(ni,nj),as));
          dist[ni][nj][as]=dist[ai][aj][as];
        }
      }

      if (otacam[ai][aj]!=-1) {
        if (dist[ai][aj][as^(1<<otacam[ai][aj])]==-1 || dist[ai][aj][as^(1<<otacam[ai][aj])]>dist[ai][aj][as]+1) {
          q.push_back(make_pair(make_pair(ai,aj),as^(1<<otacam[ai][aj])));
          dist[ai][aj][as^(1<<otacam[ai][aj])]=dist[ai][aj][as]+1;
        }
      }


    }

    return -1;
  }


};



// Powered by FileEdit
// Powered by TZTester 1.01 [25-Feb-2003]
// Powered by CodeProcessor
