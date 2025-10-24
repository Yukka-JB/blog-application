import React from 'react';

const PostsList: React.FC = () => {
  const posts = [
    { id: 1, title: 'First Post' },
    { id: 2, title: 'Second Post' },
  ];

  return (
    <div className="w-full max-w-xl space-y-4">
      {posts.map(post => (
        <div key={post.id} className="card p-4 rounded-md shadow-md bg-card text-card-foreground">
          <h2 className="text-xl font-semibold">{post.title}</h2>
        </div>
      ))}
    </div>
  );
};

export default PostsList;
