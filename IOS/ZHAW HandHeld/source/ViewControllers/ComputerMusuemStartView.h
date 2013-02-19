//
//  ComputerMusuemStartView.h
//  ZHAW HandHeld
//
//  Created by Alex Gustafson on 2/16/13.
//  Copyright (c) 2013 Alexander Gustafson. All rights reserved.
//

#import <UIKit/UIKit.h>
#import "HHArticleModel.h"
#import "HHArticleModel.h"

@interface ComputerMusuemStartView : UIViewController
{
    IBOutlet UIImageView *coverImageView;
    IBOutlet UIButton  *coverButton;
    NSNumber *linkedArticleID;
    HHArticleModel *article;
}
@property (nonatomic, retain) IBOutlet UIImageView* coverImageView;
@property (nonatomic, retain) IBOutlet UIButton *coverButton;
@property (nonatomic, retain) NSNumber *linkedArticleID;
@property (nonatomic, retain) HHArticleModel *article;

- (void)initializeWithArticle:(HHArticleModel *)a;
- (IBAction)imageButtonClicked:(id)sender;



@end
