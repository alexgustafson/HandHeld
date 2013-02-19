//
//  CMMainMenuItem.h
//  ZHAW HandHeld
//
//  Created by Alexander Gustafson on 17.02.13.
//  Copyright (c) 2013 Alexander Gustafson. All rights reserved.
//

#import <UIKit/UIKit.h>
#import "HHArticleModel.h"
#import "HHFieldModel.h"
#import "SqLiteDatabaseManager.h"

@interface CMMainMenuItem : UITableViewCell
{
    IBOutlet UILabel* label;
    UIImageView* buttonImageUp;
    HHFieldModel* field;
    SqLiteDatabaseManager* dbManager;
    UIColor* backgroundColor;
    NSNumber* linkedArticleID;
    
    UIImage *imageUp;
    UIImage *imageDown;
}
@property (nonatomic, retain) IBOutlet UILabel* label;
@property (nonatomic, retain) UIImageView* buttonImageUp;
@property (nonatomic, retain) HHFieldModel* field;
@property (nonatomic, retain) SqLiteDatabaseManager* dbManager;
@property (nonatomic, retain) UIImage* imageUp;
@property (nonatomic, retain) UIImage* imageDown;
@property (nonatomic, retain) NSNumber* linkedArticleID;

- (void)initializeWithField:(HHFieldModel *)f andHHManager:(SqLiteDatabaseManager*)db;

@end
